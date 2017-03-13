#!/usr/bin/env python
import subprocess
import sys
import os
import logging

from urlparse import urlparse
from argparse import ArgumentParser
from datetime import datetime


__description__ = """Downloads website using and disguising WGET request headers. Downloads pages recursively only on the same domain, only at deeper directories, and at safe levels. """
__author__ = "kyee"
__contact__ = "kyee@silversky.com"

LOG_DELIMETER = "*** [%s] ***\n"
END_LOG_DELIMETER = "*** [END %s] ***\n\n"

WGET = "wget"
WGET_USER_AGENT = "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0)"
WGET_LEVEL = 20
WGET_ARGUMENTS = (WGET,
                  "--recursive",                    # web scrape
                  "--no-clobber",                   # don't replace files
                  "--page-requisites",              # include images, css, etc.
                  "--html-extension",               # end it with .html
                  "--convert-links",                # make it work offline
                  "--restrict-file-names=windows",  # work on Windows OS
                  # "--no-parent",                    # no pages above url path
                  "--user-agent=%s" % WGET_USER_AGENT,
                  "--level=%d" % WGET_LEVEL,        # recursion level
                  "-e",                             # .wgetrc command(s)
                  "robots=off")
WGET_RATES = set(('b', 'k', 'm'))
WGET_RETURN_STATUS = ("No problems occurred.",
                     "Generic error code.",
                     "Parse error-for instance, when parsing command-line options, the .wgetrc or .netrc...",
                     "File I/O error.",
                     "Network failure.",
                     "SSL verification failure.",
                     "Username/password authentication failure.",
                     "Protocol errors.",
                     "Server issued an error response.")


def get_date_and_time():
    print datetime.now().strftime('%Y/%m/%d %H:%M:%S')


def scrape_webpage(url, random_wait=True, rate_limit=None, rate='K', log=None):
    """

    :param random_wait: randomly wait anywhere between 0.5 to 1.5 between gets
    :param rate_limit: integer, with rate, specifies max bandwidth.
    :param rate: 'b', 'k', or 'm' to specify bytes, kilobytes, or megabytes for
                 rate limit. 
    :param log: filename or absolute path of log file. This disables stdout.
    """
    arguments = list(WGET_ARGUMENTS)
    domain = urlparse(url).netloc
    arguments.append("--domains=%s" % domain) # only pages on same domain

    if random_wait is True:
        arguments.append("--random-wait")

    if rate_limit is not None:
        rate_limit = int(rate_limit)
        if rate.lower() not in WGET_RATES:
            raise ValueError('- Invalid rate %s. Must be from %s' % 
                            (rate, list(WGET_RATES)))
        arguments.append("--limit-rate=%s" % (str(limit_rate) + rate))
    arguments.append(url)

    if log is not None:
        arguments.extend(("-a", log))

    try:
        subprocess.check_call(arguments)
    except subprocess.CalledProcessError as e:
        rc = e.returncode
        err_str = "Error Code %d"
        if rc < len(WGET_RETURN_STATUS):
            err_str += ": %s" % WGET_RETURN_STATUS[rc]

        sys.stderr.write(err_str)
        raise e

    return None


def main(url, path, rate_limit, rate, log):
    os.chdir(path)
    if log is not None:
        f = open(log, 'a')
        f.write(LOG_DELIMETER % get_date_and_time())
        f.close()

    try:
        scrape_webpage(url, rate_limit=rate_limit, rate=rate, log=log)
    finally:
        if log is not None:
            f = open(log, 'a')
            f.write(LOG_DELIMETER % get_date_and_time())
            f.close()

    return None


if __name__ == "__main__":
    args = ArgumentParser(description=__description__)
    args.add_argument('-u', '--url', required=True, help="URL to scrape")
    args.add_argument('-p', '--path', default=os.getcwd(), help="Save path")
    args.add_argument('-rl', 
                      '--rate_limit', 
                      default=None, 
                      type=int, 
                      help="Integer rate bandwith. -r specifies bytes")
    args.add_argument('-r',
                      '--rate',
                      default='K',
                      help="b (bytes), k (kiloboytes), or m (megabytes).")
    args.add_argument('-l', '--log', default=None, help="Filename of log")
    args = args.parse_args()

    main(args.url, args.path, args.rate_limit, args.rate, args.log)
