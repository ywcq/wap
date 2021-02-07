var $I = function(id)
{
  return document.getElementById(id);
};
var names = function(obj, name)
{
  if (obj)
  {
    if (obj.className == name) obj.className = '';
    else obj.className = name;
  }
};
var music = function(obj)
{
  if (obj)
  {
    if (obj.paused) obj.play();
    else obj.pause();
  }
};
var weixin = function ()
{
  var ua = window.navigator.userAgent.toLowerCase();
  console.log(ua);
  if (ua.match(/MicroMessenger/i) == 'micromessenger') {
  return true;
  } else {
  return false;
  }
};