var RedNaoFBTextField=function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=765)}({0:function(e,t){e.exports=React},21:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Events/GetFieldOptions")},22:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Events/GetField")},23:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Events/GetModel")},24:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Fields/Core/FBFieldWithPriceBase.Model")},37:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Fields/Core/FBFieldWithPriceBase")},4:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Fields/Core/FBFieldBase.options")},5:function(e,t){e.exports=RedNaoSharedCore.default("shared/core/Events/EventManager")},7:function(e,t){e.exports=RedNaoFormBuilder.default("FormBuilder/Fields/Core/FBFieldWithPriceBase.Options")},765:function(e,t,n){"use strict";n.r(t);var r=n(0),o=n(7),i=n(4);function u(e){return(u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function l(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function a(e,t){return!t||"object"!==u(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function s(e,t,n){return(s="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(e,t,n){var r=function(e,t){for(;!Object.prototype.hasOwnProperty.call(e,t)&&null!==(e=c(e)););return e}(e,t);if(r){var o=Object.getOwnPropertyDescriptor(r,t);return o.get?o.get.call(n):o.value}})(e,t,n||e)}function c(e){return(c=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function f(e,t){return(f=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var p=function(e){function t(){var e,n;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);for(var r=arguments.length,o=new Array(r),i=0;i<r;i++)o[i]=arguments[i];return(n=a(this,(e=c(t)).call.apply(e,[this].concat(o)))).DefaultText=void 0,n.Placeholder=void 0,n.ShowQuantitySelector=void 0,n.FreeCharOrWords=0,n.IgnoreSpaces=void 0,n}var n,r,u;return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&f(e,t)}(t,o["FBFieldWithPriceBaseOptions"]),n=t,(r=[{key:"LoadDefaultValues",value:function(){s(c(t.prototype),"LoadDefaultValues",this).call(this),this.Type=i.FieldTypeEnum.Text,this.Label="Text box",this.IgnoreSpaces=!1,this.ShowQuantitySelector=!1,this.QuantityPosition="bottom",this.QuantityMaximumValue=0,this.QuantityMinimumValue=0,this.QuantityDefaultValue="",this.QuantityPlaceholder="",this.QuantityLabel="Quantity",this.Placeholder="",this.DefaultText="",this.PriceType=o.PriceTypeEnum.fixed_amount,this.FreeCharOrWords=0}}])&&l(n.prototype,r),u&&l(n,u),t}(),y=n(37),d=n(24);function h(e){return(h="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function b(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function m(e,t){return!t||"object"!==h(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function v(e,t,n){return(v="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(e,t,n){var r=function(e,t){for(;!Object.prototype.hasOwnProperty.call(e,t)&&null!==(e=O(e)););return e}(e,t);if(r){var o=Object.getOwnPropertyDescriptor(r,t);return o.get?o.get.call(n):o.value}})(e,t,n||e)}function O(e){return(O=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function P(e,t){return(P=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var F=function(e){function t(e,n){var r;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),(r=m(this,O(t).call(this,e,n))).Text=void 0,r}var n,r,o;return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&P(e,t)}(t,d["FBFieldWithPriceBaseModel"]),n=t,(r=[{key:"InternalSerialize",value:function(e){v(O(t.prototype),"InternalSerialize",this).call(this,e),e.Value=this.GetValue()}},{key:"GetStoresInformation",value:function(){return!0}},{key:"GetIsUsed",value:function(){return""!=this.Text.trim()}},{key:"GetValue",value:function(){return this.GetIsVisible()?this.Text:""}},{key:"InitializeStartingValues",value:function(){this.Text=this.GetPreviousDataProperty("Value",this.Options.DefaultText),this.Quantity=this.GetPreviousDataProperty("Quantity",""==this.Options.QuantityDefaultValue?"":this.ParseNumber(this.Options.QuantityDefaultValue))}},{key:"GetDynamicFieldNames",value:function(){return["FBTextField"]}}])&&b(n.prototype,r),o&&b(n,o),t}(),g=n(23),x=n(21),M=n(22),T=n(5);function S(e){return(S="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function w(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function B(e,t){return!t||"object"!==S(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function E(e){return(E=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function Q(e,t){return(Q=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}n.d(t,"FBTextField",function(){return j});var j=function(e){function t(e){return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),B(this,E(t).call(this,e))}var n,i,u;return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&Q(e,t)}(t,y["FBFieldWithPriceBase"]),n=t,(i=[{key:"componentWillReceiveProps",value:function(e,t){this.Model.Parent.IsDesign&&(this.Model.Text=this.Model.Options.DefaultText,this.Model.Quantity=""==this.Model.Options.QuantityDefaultValue?"":this.Model.ParseNumber(this.Model.Options.QuantityDefaultValue))}},{key:"SubRender",value:function(){return this.props.Model.Options.ShowQuantitySelector&&this.props.Model.Options.PriceType!=o.PriceTypeEnum.quantity?"bottom"==this.props.Model.Options.QuantityPosition||"right"==this.props.Model.Options.QuantityPosition?r.createElement(r.Fragment,null,this.GetInput(this.props.Model.Options.QuantityPosition),this.GetQuantityInput(),this.GetPriceOrRequiredBox()):r.createElement(r.Fragment,null,this.GetQuantityInput(),this.GetInput(this.props.Model.Options.QuantityPosition),this.GetPriceOrRequiredBox()):r.createElement(r.Fragment,null,this.GetInput(""),this.GetPriceOrRequiredBox())}},{key:"GetQuantityInput",value:function(){var e=this;return r.createElement("div",{className:"rnTextFieldQuantity "+this.props.Model.Options.QuantityPosition},r.createElement("div",{className:"rednaoLabel"},r.createElement("label",{style:{fontWeight:"bold"}},this.props.Model.Options.QuantityLabel)),r.createElement("input",{className:"rnInputQuantity",placeholder:this.Model.Options.QuantityPlaceholder,style:{width:"100%"},type:"text",value:this.Model.Quantity,onChange:function(t){e.Model.Quantity=e.Model.ParseNumber(t.target.value),e.Model.Refresh()}}))}},{key:"GetInput",value:function(e){var t=this;return r.createElement("div",{className:"rnTextFieldInput "+e},this.GetLabel(),r.createElement("input",{className:"rnInputPrice",placeholder:this.props.Model.Options.Placeholder,style:{width:"100%"},type:"text",value:this.Model.Text,onChange:function(e){return t.OnChange(e)}}))}},{key:"OnChange",value:function(e){""!=this.Model.Text.trim()&&this.Model.RemoveError("required"),this.Model.Text=e.target.value,this.Model.Quantity=e.target.value.trim().length>0&&0==this.Model.Quantity?1:this.Model.Quantity,this.Model.FireValueChanged()}}])&&w(n.prototype,i),u&&w(n,u),t}();j.defaultProps={},T.EventManager.Subscribe(g.GetModel,function(e){if(e.Options.Type==i.FieldTypeEnum.Text)return new F(e.Options,e.parent).Initialize(e.PreviousData)}),T.EventManager.Subscribe(x.GetFieldOptions,function(e){if(e.Type==i.FieldTypeEnum.Text)return new p}),T.EventManager.Subscribe(M.GetField,function(e){if(e.Model.Options.Type==i.FieldTypeEnum.Text)return r.createElement(j,{Model:e.Model})})}});
//# sourceMappingURL=FBTextField_bundle.js.map