;(function(window) {

var svgSprite = '<svg>' +
  ''+
    '<symbol id="iconfontyonghu" viewBox="0 0 1024 1024">'+
      ''+
      '<path d="M853.333333 725.333333c-39.552-13.610667-79.786667-27.946667-128-42.666667-64.554667-19.712-128.896-42.752-128.896-42.752l0-42.666667c0 0 85.333333-85.248 85.333333-256 0-42.666667 0.042667-53.802667 0.042667-84.650667 0-107.349333-77.226667-165.632-169.813333-171.093333L512 85.418667c0 0 0 0 0 0s0 0 0 0l0 0.128c-92.586667 5.461333-169.813333 63.744-169.813333 171.093333 0 30.848 0.042667 41.984 0.042667 84.650667 0 170.752 85.333333 256 85.333333 256l0 42.666667c0 0-64.341333 23.04-128.896 42.752-48.213333 14.72-88.448 29.056-128 42.666667-85.333333 29.354667-85.333333 170.666667-85.333333 170.666667l0 42.666667 426.666667 0 426.666667 0 0-42.666667C938.666667 896 938.666667 754.688 853.333333 725.333333z"  ></path>'+
      ''+
    '</symbol>'+
  ''+
'</svg>'
var script = function() {
    var scripts = document.getElementsByTagName('script')
    return scripts[scripts.length - 1]
  }()
var shouldInjectCss = script.getAttribute("data-injectcss")

/**
 * document ready
 */
var ready = function(fn){
  if(document.addEventListener){
      document.addEventListener("DOMContentLoaded",function(){
          document.removeEventListener("DOMContentLoaded",arguments.callee,false)
          fn()
      },false)
  }else if(document.attachEvent){
     IEContentLoaded (window, fn)
  }

  function IEContentLoaded (w, fn) {
      var d = w.document, done = false,
      // only fire once
      init = function () {
          if (!done) {
              done = true
              fn()
          }
      }
      // polling for no errors
      ;(function () {
          try {
              // throws errors until after ondocumentready
              d.documentElement.doScroll('left')
          } catch (e) {
              setTimeout(arguments.callee, 50)
              return
          }
          // no errors, fire

          init()
      })()
      // trying to always fire before onload
      d.onreadystatechange = function() {
          if (d.readyState == 'complete') {
              d.onreadystatechange = null
              init()
          }
      }
  }
}

/**
 * Insert el before target
 *
 * @param {Element} el
 * @param {Element} target
 */

var before = function (el, target) {
  target.parentNode.insertBefore(el, target)
}

/**
 * Prepend el to target
 *
 * @param {Element} el
 * @param {Element} target
 */

var prepend = function (el, target) {
  if (target.firstChild) {
    before(el, target.firstChild)
  } else {
    target.appendChild(el)
  }
}

function appendSvg(){
  var div,svg

  div = document.createElement('div')
  div.innerHTML = svgSprite
  svg = div.getElementsByTagName('svg')[0]
  if (svg) {
    svg.setAttribute('aria-hidden', 'true')
    svg.style.position = 'absolute'
    svg.style.width = 0
    svg.style.height = 0
    svg.style.overflow = 'hidden'
    prepend(svg,document.body)
  }
}

if(shouldInjectCss && !window.__iconfont__svg__cssinject__){
  window.__iconfont__svg__cssinject__ = true
  try{
    document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>");
  }catch(e){
    console && console.log(e)
  }
}

ready(appendSvg)


})(window)
