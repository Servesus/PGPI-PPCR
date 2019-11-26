var RedNaoFBMaskedField=function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=780)}({0:function(e,t){e.exports=React},21:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Events/GetFieldOptions")},22:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Events/GetField")},225:function(e,t,n){"use strict";n.d(t,"a",function(){return p}),n.d(t,"b",function(){return f});var o=n(7),r=n(4);function i(e){return(i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function a(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function s(e,t){return!t||"object"!==i(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function u(e,t,n){return(u="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(e,t,n){var o=function(e,t){for(;!Object.prototype.hasOwnProperty.call(e,t)&&null!==(e=l(e)););return e}(e,t);if(o){var r=Object.getOwnPropertyDescriptor(o,t);return r.get?r.get.call(n):r.value}})(e,t,n||e)}function l(e){return(l=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function c(e,t){return(c=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var f,p=function(e){function t(){var e,n;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);for(var o=arguments.length,r=new Array(o),i=0;i<o;i++)r[i]=arguments[i];return(n=s(this,(e=l(t)).call.apply(e,[this].concat(r)))).DefaultText=void 0,n.Placeholder=void 0,n.MaskType=void 0,n.Mask="",n.ShowQuantitySelector=void 0,n.MaskChar=void 0,n}var n,i,p;return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&c(e,t)}(t,o["FBFieldWithPriceBaseOptions"]),n=t,(i=[{key:"LoadDefaultValues",value:function(){u(l(t.prototype),"LoadDefaultValues",this).call(this),this.Type=r.FieldTypeEnum.Masked,this.Label="Mask",this.MaskType=f.Phone,this.Mask="(999)99-999-999",this.MaskChar="_",this.ShowQuantitySelector=!1,this.QuantityPosition="bottom",this.QuantityMaximumValue=0,this.QuantityMinimumValue=0,this.QuantityDefaultValue="",this.QuantityPlaceholder="",this.QuantityLabel="Quantity",this.Placeholder="",this.DefaultText="",this.PriceType=o.PriceTypeEnum.none}}])&&a(n.prototype,i),p&&a(n,p),t}();!function(e){e.Phone="phone",e.CreditCard="credit_card",e.Custom="custom"}(f||(f={}))},23:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Events/GetModel")},24:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Fields/Core/FBFieldWithPriceBase.Model")},37:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Fields/Core/FBFieldWithPriceBase")},39:function(e,t){e.exports=ReactDOM},4:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Fields/Core/FBFieldBase.options")},492:function(e,t,n){e.exports=n(493)},493:function(e,t,n){"use strict";var o,r=(o=n(0))&&"object"==typeof o&&"default"in o?o.default:o,i=n(39);function a(){return(a=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e}).apply(this,arguments)}function s(e,t){e.prototype=Object.create(t.prototype),function(e,t){for(var n=Object.getOwnPropertyNames(t),o=0;o<n.length;o++){var r=n[o],i=Object.getOwnPropertyDescriptor(t,r);i&&i.configurable&&void 0===e[r]&&Object.defineProperty(e,r,i)}}(e.prototype.constructor=e,t)}function u(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}var l=function(e,t,n,o,r,i,a,s){if(!e){var u;if(void 0===t)u=new Error("Minified exception occurred; use the non-minified dev environment for the full error message and additional helpful warnings.");else{var l=[n,o,r,i,a,s],c=0;(u=new Error(t.replace(/%s/g,function(){return l[c++]}))).name="Invariant Violation"}throw u.framesToPop=1,u}};function c(e,t,n){if("selectionStart"in e&&"selectionEnd"in e)e.selectionStart=t,e.selectionEnd=n;else{var o=e.createTextRange();o.collapse(!0),o.moveStart("character",t),o.moveEnd("character",n-t),o.select()}}var f={9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},p="_";function h(e,t,n){var o="",r="",i=null,a=[];if(void 0===t&&(t=p),null==n&&(n=f),!e||"string"!=typeof e)return{maskChar:t,formatChars:n,mask:null,prefix:null,lastEditablePosition:null,permanents:[]};var s=!1;return e.split("").forEach(function(e){s=!s&&"\\"===e||(s||!n[e]?(a.push(o.length),o.length===a.length-1&&(r+=e)):i=o.length+1,o+=e,!1)}),{maskChar:t,formatChars:n,prefix:r,mask:o,lastEditablePosition:i,permanents:a}}function d(e,t){return-1!==e.permanents.indexOf(t)}function m(e,t,n){var o=e.mask,r=e.formatChars;if(!n)return!1;if(d(e,t))return o[t]===n;var i=r[o[t]];return new RegExp(i).test(n)}function v(e,t){return t.split("").every(function(t,n){return d(e,n)||!m(e,n,t)})}function y(e,t){var n=e.maskChar,o=e.prefix;if(!n){for(;t.length>o.length&&d(e,t.length-1);)t=t.slice(0,t.length-1);return t.length}for(var r=o.length,i=t.length;i>=o.length;i--){var a=t[i];if(!d(e,i)&&m(e,i,a)){r=i+1;break}}return r}function g(e,t){return y(e,t)===e.mask.length}function b(e,t){var n=e.maskChar,o=e.mask,r=e.prefix;if(!n){for((t=k(e,"",t,0)).length<r.length&&(t=r);t.length<o.length&&d(e,t.length);)t+=o[t.length];return t}if(t)return k(e,b(e,""),t,0);for(var i=0;i<o.length;i++)d(e,i)?t+=o[i]:t+=n;return t}function k(e,t,n,o){var r=e.mask,i=e.maskChar,a=e.prefix,s=n.split(""),u=g(e,t);return!i&&o>t.length&&(t+=r.slice(t.length,o)),s.every(function(n){for(;c=n,d(e,l=o)&&c!==r[l];){if(o>=t.length&&(t+=r[o]),s=n,i&&d(e,o)&&s===i)return!0;if(++o>=r.length)return!1}var s,l,c;return!m(e,o,n)&&n!==i||(o<t.length?t=i||u||o<a.length?t.slice(0,o)+n+t.slice(o+1):(t=t.slice(0,o)+n+t.slice(o),b(e,t)):i||(t+=n),++o<r.length)}),t}function O(e,t){for(var n=e.mask,o=t;o<n.length;++o)if(!d(e,o))return o;return null}function M(e){return e||0===e?e+"":""}function w(e,t,n,o,r){var i=e.mask,a=e.prefix,s=e.lastEditablePosition,u=t,l="",c=0,f=0,p=Math.min(r.start,n.start);return n.end>r.start?f=(c=function(e,t,n,o){var r=e.mask,i=e.maskChar,a=n.split(""),s=o;return a.every(function(t){for(;a=t,d(e,n=o)&&a!==r[n];)if(++o>=r.length)return!1;var n,a;return(m(e,o,t)||t===i)&&o++,o<r.length}),o-s}(e,0,l=u.slice(r.start,n.end),p))?r.length:0:u.length<o.length&&(f=o.length-u.length),u=o,f&&(1!==f||r.length||(p=r.start===n.start?O(e,n.start):function(e,t){for(var n=t;0<=n;--n)if(!d(e,n))return n;return null}(e,n.start)),u=function(e,t,n,o){var r=n+o,i=e.maskChar,a=e.mask,s=e.prefix,u=t.split("");if(i)return u.map(function(t,o){return o<n||r<=o?t:d(e,o)?a[o]:i}).join("");for(var l=r;l<u.length;l++)d(e,l)&&(u[l]="");return n=Math.max(s.length,n),u.splice(n,r-n),t=u.join(""),b(e,t)}(e,u,p,f)),u=k(e,u,l,p),(p+=c)>=i.length?p=i.length:p<a.length&&!c?p=a.length:p>=a.length&&p<s&&c&&(p=O(e,p)),l||(l=null),{value:u=b(e,u),enteredString:l,selection:{start:p,end:p}}}function S(e){return"function"==typeof e}function P(){return window.cancelAnimationFrame||window.webkitCancelRequestAnimationFrame||window.webkitCancelAnimationFrame||window.mozCancelAnimationFrame}function C(e){return(P()?window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame:function(){return setTimeout(e,1e3/60)})(e)}function F(e){(P()||clearTimeout)(e)}var E=function(e){function t(t){var n=e.call(this,t)||this;n.focused=!1,n.mounted=!1,n.previousSelection=null,n.selectionDeferId=null,n.saveSelectionLoopDeferId=null,n.saveSelectionLoop=function(){n.previousSelection=n.getSelection(),n.saveSelectionLoopDeferId=C(n.saveSelectionLoop)},n.runSaveSelectionLoop=function(){null===n.saveSelectionLoopDeferId&&n.saveSelectionLoop()},n.stopSaveSelectionLoop=function(){null!==n.saveSelectionLoopDeferId&&(F(n.saveSelectionLoopDeferId),n.saveSelectionLoopDeferId=null,n.previousSelection=null)},n.getInputDOMNode=function(){if(!n.mounted)return null;var e=i.findDOMNode(u(u(n))),t="undefined"!=typeof window&&e instanceof window.Element;if(e&&!t)return null;if("INPUT"!==e.nodeName&&(e=e.querySelector("input")),!e)throw new Error("react-input-mask: inputComponent doesn't contain input node");return e},n.getInputValue=function(){var e=n.getInputDOMNode();return e?e.value:null},n.setInputValue=function(e){var t=n.getInputDOMNode();t&&(n.value=e,t.value=e)},n.setCursorToEnd=function(){var e=y(n.maskOptions,n.value),t=O(n.maskOptions,e);null!==t&&n.setCursorPosition(t)},n.setSelection=function(e,t,o){void 0===o&&(o={});var r=n.getInputDOMNode(),i=n.isFocused();r&&i&&(o.deferred||c(r,e,t),null!==n.selectionDeferId&&F(n.selectionDeferId),n.selectionDeferId=C(function(){n.selectionDeferId=null,c(r,e,t)}),n.previousSelection={start:e,end:t,length:Math.abs(t-e)})},n.getSelection=function(){return function(e){var t=0,n=0;if("selectionStart"in e&&"selectionEnd"in e)t=e.selectionStart,n=e.selectionEnd;else{var o=document.selection.createRange();o.parentElement()===e&&(t=-o.moveStart("character",-e.value.length),n=-o.moveEnd("character",-e.value.length))}return{start:t,end:n,length:n-t}}(n.getInputDOMNode())},n.getCursorPosition=function(){return n.getSelection().start},n.setCursorPosition=function(e){n.setSelection(e,e)},n.isFocused=function(){return n.focused},n.getBeforeMaskedValueChangeConfig=function(){var e=n.maskOptions,t=e.mask,o=e.maskChar,r=e.permanents,i=e.formatChars;return{mask:t,maskChar:o,permanents:r,alwaysShowMask:!!n.props.alwaysShowMask,formatChars:i}},n.isInputAutofilled=function(e,t,o,r){var i=n.getInputDOMNode();try{if(i.matches(":-webkit-autofill"))return!0}catch(e){}return!n.focused||r.end<o.length&&t.end===e.length},n.onChange=function(e){var t=u(u(n)).beforePasteState,o=u(u(n)).previousSelection,r=n.props.beforeMaskedValueChange,i=n.getInputValue(),a=n.value,s=n.getSelection();n.isInputAutofilled(i,s,a,o)&&(a=b(n.maskOptions,""),o={start:0,end:0,length:0}),t&&(o=t.selection,a=t.value,s={start:o.start+i.length,end:o.start+i.length,length:0},i=a.slice(0,o.start)+i+a.slice(o.end),n.beforePasteState=null);var l=w(n.maskOptions,i,s,a,o),c=l.enteredString,f=l.selection,p=l.value;if(S(r)){var h=r({value:p,selection:f},{value:a,selection:o},c,n.getBeforeMaskedValueChangeConfig());p=h.value,f=h.selection}n.setInputValue(p),S(n.props.onChange)&&n.props.onChange(e),n.isWindowsPhoneBrowser?n.setSelection(f.start,f.end,{deferred:!0}):n.setSelection(f.start,f.end)},n.onFocus=function(e){var t=n.props.beforeMaskedValueChange,o=n.maskOptions,r=o.mask,i=o.prefix;if(n.focused=!0,n.mounted=!0,r){if(n.value)y(n.maskOptions,n.value)<n.maskOptions.mask.length&&n.setCursorToEnd();else{var a=b(n.maskOptions,i),s=b(n.maskOptions,a),u=y(n.maskOptions,s),l=O(n.maskOptions,u),c={start:l,end:l};if(S(t)){var f=t({value:s,selection:c},{value:n.value,selection:null},null,n.getBeforeMaskedValueChangeConfig());s=f.value,c=f.selection}var p=s!==n.getInputValue();p&&n.setInputValue(s),p&&S(n.props.onChange)&&n.props.onChange(e),n.setSelection(c.start,c.end)}n.runSaveSelectionLoop()}S(n.props.onFocus)&&n.props.onFocus(e)},n.onBlur=function(e){var t=n.props.beforeMaskedValueChange,o=n.maskOptions.mask;if(n.stopSaveSelectionLoop(),n.focused=!1,o&&!n.props.alwaysShowMask&&v(n.maskOptions,n.value)){var r="";S(t)&&(r=t({value:r,selection:null},{value:n.value,selection:n.previousSelection},null,n.getBeforeMaskedValueChangeConfig()).value);var i=r!==n.getInputValue();i&&n.setInputValue(r),i&&S(n.props.onChange)&&n.props.onChange(e)}S(n.props.onBlur)&&n.props.onBlur(e)},n.onMouseDown=function(e){if(!n.focused&&document.addEventListener){n.mouseDownX=e.clientX,n.mouseDownY=e.clientY,n.mouseDownTime=(new Date).getTime();document.addEventListener("mouseup",function e(t){if(document.removeEventListener("mouseup",e),n.focused){var o=Math.abs(t.clientX-n.mouseDownX),r=Math.abs(t.clientY-n.mouseDownY),i=Math.max(o,r),a=(new Date).getTime()-n.mouseDownTime;(i<=10&&a<=200||i<=5&&a<=300)&&n.setCursorToEnd()}})}S(n.props.onMouseDown)&&n.props.onMouseDown(e)},n.onPaste=function(e){S(n.props.onPaste)&&n.props.onPaste(e),e.defaultPrevented||(n.beforePasteState={value:n.getInputValue(),selection:n.getSelection()},n.setInputValue(""))},n.handleRef=function(e){null==n.props.children&&S(n.props.inputRef)&&n.props.inputRef(e)};var o=t.mask,r=t.maskChar,a=t.formatChars,s=t.alwaysShowMask,l=t.beforeMaskedValueChange,f=t.defaultValue,p=t.value;n.maskOptions=h(o,r,a),null==f&&(f=""),null==p&&(p=f);var d=M(p);if(n.maskOptions.mask&&(s||d)&&(d=b(n.maskOptions,d),S(l))){var m=t.value;null==t.value&&(m=f),d=l({value:d,selection:null},{value:m=M(m),selection:null},null,n.getBeforeMaskedValueChangeConfig()).value}return n.value=d,n}s(t,e);var n=t.prototype;return n.componentDidMount=function(){this.mounted=!0,this.getInputDOMNode()&&(this.isWindowsPhoneBrowser=function(){var e=new RegExp("windows","i"),t=new RegExp("phone","i"),n=navigator.userAgent;return e.test(n)&&t.test(n)}(),this.maskOptions.mask&&this.getInputValue()!==this.value&&this.setInputValue(this.value))},n.componentDidUpdate=function(){var e=this.previousSelection,t=this.props,n=t.beforeMaskedValueChange,o=t.alwaysShowMask,r=t.mask,i=t.maskChar,a=t.formatChars,s=this.maskOptions,u=o||this.isFocused(),l=null!=this.props.value,c=l?M(this.props.value):this.value,f=e?e.start:null;if(this.maskOptions=h(r,i,a),this.maskOptions.mask){!s.mask&&this.isFocused()&&this.runSaveSelectionLoop();var p=this.maskOptions.mask&&this.maskOptions.mask!==s.mask;if(s.mask||l||(c=this.getInputValue()),(p||this.maskOptions.mask&&(c||u))&&(c=b(this.maskOptions,c)),p){var d=y(this.maskOptions,c);(null===f||d<f)&&(f=g(this.maskOptions,c)?d:O(this.maskOptions,d))}!this.maskOptions.mask||!v(this.maskOptions,c)||u||l&&this.props.value||(c="");var m={start:f,end:f};if(S(n)){var k=n({value:c,selection:m},{value:this.value,selection:this.previousSelection},null,this.getBeforeMaskedValueChangeConfig());c=k.value,m=k.selection}this.value=c;var w=this.getInputValue()!==this.value;w?(this.setInputValue(this.value),this.forceUpdate()):p&&this.forceUpdate();var P=!1;null!=m.start&&null!=m.end&&(P=!e||e.start!==m.start||e.end!==m.end),(P||w)&&this.setSelection(m.start,m.end)}else s.mask&&(this.stopSaveSelectionLoop(),this.forceUpdate())},n.componentWillUnmount=function(){this.mounted=!1,null!==this.selectionDeferId&&F(this.selectionDeferId),this.stopSaveSelectionLoop()},n.render=function(){var e,t=this.props,n=(t.mask,t.alwaysShowMask,t.maskChar,t.formatChars,t.inputRef,t.beforeMaskedValueChange,t.children),o=function(e,t){if(null==e)return{};var n,o,r={},i=Object.keys(e);for(o=0;o<i.length;o++)n=i[o],0<=t.indexOf(n)||(r[n]=e[n]);return r}(t,["mask","alwaysShowMask","maskChar","formatChars","inputRef","beforeMaskedValueChange","children"]);if(n){S(n)||l(!1);var i=["onChange","onPaste","onMouseDown","onFocus","onBlur","value","disabled","readOnly"],s=a({},o);i.forEach(function(e){return delete s[e]}),e=n(s),i.filter(function(t){return null!=e.props[t]&&e.props[t]!==o[t]}).length&&l(!1)}else e=r.createElement("input",a({ref:this.handleRef},o));var u={onFocus:this.onFocus,onBlur:this.onBlur};return this.maskOptions.mask&&(o.disabled||o.readOnly||(u.onChange=this.onChange,u.onPaste=this.onPaste,u.onMouseDown=this.onMouseDown),null!=o.value&&(u.value=this.value)),e=r.cloneElement(e,u)},t}(r.Component);e.exports=E},5:function(e,t){e.exports=RedNaoSharedCore.default("shared/core/Events/EventManager")},7:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Fields/Core/FBFieldWithPriceBase.Options")},780:function(e,t,n){"use strict";n.r(t);var o=n(0),r=n(37),i=n(7),a=n(23),s=n(4),u=n(21),l=n(22),c=n(225),f=n(24);function p(e){return(p="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function h(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function d(e,t){return!t||"object"!==p(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function m(e,t,n){return(m="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(e,t,n){var o=function(e,t){for(;!Object.prototype.hasOwnProperty.call(e,t)&&null!==(e=v(e)););return e}(e,t);if(o){var r=Object.getOwnPropertyDescriptor(o,t);return r.get?r.get.call(n):r.value}})(e,t,n||e)}function v(e){return(v=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function y(e,t){return(y=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var g=function(e){function t(e,n){var o;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),(o=d(this,v(t).call(this,e,n))).Text=void 0,o}var n,o,r;return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&y(e,t)}(t,f["FBFieldWithPriceBaseModel"]),n=t,(o=[{key:"InitializeStartingValues",value:function(e){this.Text=this.GetPreviousDataProperty("Value",this.Options.DefaultText),this.Quantity=this.GetPreviousDataProperty("Quantity",""==this.Options.QuantityDefaultValue?"":this.ParseNumber(this.Options.QuantityDefaultValue))}},{key:"InternalSerialize",value:function(e){m(v(t.prototype),"InternalSerialize",this).call(this,e),e.Value=this.GetValue()}},{key:"GetDynamicFieldNames",value:function(){return["FBMaskedField"]}},{key:"GetStoresInformation",value:function(){return!0}},{key:"GetIsUsed",value:function(){return""!=this.GetValue()}},{key:"GetValue",value:function(){return-1!=this.Text.trim().indexOf(this.Options.MaskChar)?"":this.Text.trim()}}])&&h(n.prototype,o),r&&h(n,r),t}(),b=n(5);function k(e){return(k="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function O(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function M(e,t){return!t||"object"!==k(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function w(e){return(w=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function S(e,t){return(S=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}n.d(t,"FBMaskedField",function(){return C});var P=n(492),C=function(e){function t(e){return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),M(this,w(t).call(this,e))}var n,a,s;return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&S(e,t)}(t,r["FBFieldWithPriceBase"]),n=t,(a=[{key:"componentWillReceiveProps",value:function(e,t){this.Model.Parent.IsDesign&&(this.Model.Text=this.Model.Options.DefaultText,this.Model.Quantity=""==this.Model.Options.QuantityDefaultValue?"":this.Model.ParseNumber(this.Model.Options.QuantityDefaultValue))}},{key:"SubRender",value:function(){return this.props.Model.Options.ShowQuantitySelector&&this.props.Model.Options.PriceType!=i.PriceTypeEnum.quantity?"bottom"==this.props.Model.Options.QuantityPosition||"right"==this.props.Model.Options.QuantityPosition?o.createElement(o.Fragment,null,this.GetInput(this.props.Model.Options.QuantityPosition),this.GetQuantityInput(),this.GetPriceOrRequiredBox()):o.createElement(o.Fragment,null,this.GetQuantityInput(),this.GetInput(this.props.Model.Options.QuantityPosition),this.GetPriceOrRequiredBox()):o.createElement(o.Fragment,null,this.GetInput(""),this.GetPriceOrRequiredBox())}},{key:"GetQuantityInput",value:function(){var e=this;return o.createElement("div",{className:"rnTextFieldQuantity "+this.props.Model.Options.QuantityPosition},o.createElement("div",{className:"rednaoLabel"},o.createElement("label",{style:{fontWeight:"bold"}},this.props.Model.Options.QuantityLabel)),o.createElement("input",{className:"rnInputQuantity",placeholder:this.Model.Options.QuantityPlaceholder,style:{width:"100%"},type:"text",value:this.Model.Quantity,onChange:function(t){e.Model.Quantity=e.Model.ParseNumber(t.target.value),e.Model.Refresh()}}))}},{key:"GetInput",value:function(e){var t=this;return o.createElement("div",{className:"rnTextFieldInput "+e},this.GetLabel(),o.createElement(P,{maskChar:this.Model.Options.MaskChar,mask:this.Model.Options.Mask,className:"rnInputPrice",placeholder:this.props.Model.Options.Placeholder,style:{width:"100%"},type:"text",value:this.Model.Text,onChange:function(e){return t.OnChange(e)}}))}},{key:"OnChange",value:function(e){""!=this.Model.Text.trim()&&this.Model.RemoveError("required"),console.log(e.target.value),this.Model.Text=e.target.value,this.Model.Quantity=e.target.value.trim().length>0&&0==this.Model.Quantity?1:this.Model.Quantity,this.Model.FireValueChanged()}}])&&O(n.prototype,a),s&&O(n,s),t}();C.defaultProps={},b.EventManager.Subscribe(a.GetModel,function(e){if(e.Options.Type==s.FieldTypeEnum.Masked)return new g(e.Options,e.parent).Initialize(e.PreviousData)}),b.EventManager.Subscribe(u.GetFieldOptions,function(e){if(e.Type==s.FieldTypeEnum.Masked)return new c.a}),b.EventManager.Subscribe(l.GetField,function(e){if(e.Model.Options.Type==s.FieldTypeEnum.Masked)return o.createElement(C,{Model:e.Model})})}});
//# sourceMappingURL=FBMaskedField_bundle.js.map