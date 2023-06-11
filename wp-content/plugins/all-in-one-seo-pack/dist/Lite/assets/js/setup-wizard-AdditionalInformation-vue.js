(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["setup-wizard-AdditionalInformation-vue"],{"0b04":function(a,t,i){"use strict";i.r(t);var n=function(){var a=this,t=a.$createElement,i=a._self._c||t;return i("div",{staticClass:"aioseo-wizard-additional-information"},[i("wizard-header"),i("wizard-container",[i("wizard-body",{scopedSlots:a._u([{key:"footer",fn:function(){return[i("div",{staticClass:"go-back"},[i("router-link",{staticClass:"no-underline",attrs:{to:a.getPrevLink}},[a._v("←")]),a._v("   "),i("router-link",{attrs:{to:a.getPrevLink}},[a._v(a._s(a.strings.goBack))])],1),i("div",{staticClass:"spacer"}),i("base-button",{attrs:{type:"blue",loading:a.loading},on:{click:a.saveAndContinue}},[a._v(a._s(a.strings.saveAndContinue)+" →")])]},proxy:!0}])},[i("wizard-steps"),i("div",{staticClass:"header"},[a._v(" "+a._s(a.strings.additionalSiteInformation)+" ")]),i("div",{staticClass:"person-or-organization aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.personOrOrganization))])]),i("base-radio-toggle",{attrs:{name:"siteRepresents",options:[{label:a.strings.person,value:"person"},{label:a.strings.organization,value:"organization"}]},model:{value:a.additionalInformation.siteRepresents,callback:function(t){a.$set(a.additionalInformation,"siteRepresents",t)},expression:"additionalInformation.siteRepresents"}}),i("div",{staticClass:"aioseo-description"},[a._v(" "+a._s(a.strings.personOrOrganizationDescription)+" ")])],1),"person"===a.additionalInformation.siteRepresents?i("div",{staticClass:"aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.choosePerson))])]),i("base-select",{staticClass:"person-chooser",attrs:{options:a.users,value:a.getPersonOptions(a.additionalInformation.person)},on:{input:function(t){return a.additionalInformation.person=t.value}},scopedSlots:a._u([{key:"singleLabel",fn:function(t){var n=t.option;return[i("div",{staticClass:"person-label"},[n.gravatar?i("div",{staticClass:"person-avatar"},[i("img",{attrs:{src:n.gravatar}})]):a._e(),i("div",{staticClass:"person-name"},[a._v(" "+a._s(n.label)+" ")])])]}},{key:"option",fn:function(t){var n=t.option;return[i("div",{staticClass:"person-label"},[n.gravatar?i("div",{staticClass:"person-avatar"},[i("img",{attrs:{src:n.gravatar}})]):a._e(),i("div",{staticClass:"person-name"},[a._v(" "+a._s(n.label)+" ")])])]}}],null,!1,1262403990)})],1):a._e(),"organization"===a.additionalInformation.siteRepresents?i("div",{staticClass:"schema-graph-name aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.organizationName))])]),i("base-input",{attrs:{size:"medium"},model:{value:a.additionalInformation.organizationName,callback:function(t){a.$set(a.additionalInformation,"organizationName",t)},expression:"additionalInformation.organizationName"}})],1):a._e(),"organization"!==a.additionalInformation.siteRepresents&&"manual"===a.additionalInformation.person?i("div",{staticClass:"schema-graph-name aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.name))])]),i("base-input",{attrs:{size:"medium"},model:{value:a.additionalInformation.personName,callback:function(t){a.$set(a.additionalInformation,"personName",t)},expression:"additionalInformation.personName"}})],1):a._e(),"organization"===a.additionalInformation.siteRepresents?i("div",{staticClass:"schema-graph-phone aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.phone))])]),i("base-phone",{model:{value:a.additionalInformation.phone,callback:function(t){a.$set(a.additionalInformation,"phone",t)},expression:"additionalInformation.phone"}})],1):a._e(),"organization"===a.additionalInformation.siteRepresents?i("div",{staticClass:"schema-graph-contact-type aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.contactType))])]),i("base-select",{attrs:{size:"medium",options:a.$constants.CONTACT_TYPES,placeholder:a.strings.chooseContactType,value:a.getContactTypeOptions(a.additionalInformation.contactType)},on:{input:function(t){return a.additionalInformation.contactType=t.value}}}),i("div",{staticClass:"aioseo-description"},[a._v(" "+a._s(a.strings.contactTypeDescription)+" ")])],1):a._e(),"organization"===a.additionalInformation.siteRepresents&&"manual"===a.additionalInformation.contactType?i("div",{staticClass:"schema-graph-contact-type-manual aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.contactType))])]),i("base-input",{attrs:{size:"medium"},model:{value:a.additionalInformation.contactTypeManual,callback:function(t){a.$set(a.additionalInformation,"contactTypeManual",t)},expression:"additionalInformation.contactTypeManual"}})],1):a._e(),"organization"===a.additionalInformation.siteRepresents?i("div",{staticClass:"schema-graph-image aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.logo))])]),i("div",{staticClass:"image-upload"},[i("base-input",{attrs:{size:"medium",placeholder:a.strings.pasteYourImageUrl},model:{value:a.additionalInformation.organizationLogo,callback:function(t){a.$set(a.additionalInformation,"organizationLogo",t)},expression:"additionalInformation.organizationLogo"}}),i("base-button",{staticClass:"insert-image",attrs:{size:"medium",type:"black"},on:{click:function(t){return a.openUploadModal("organizationLogo",["additionalInformation","organizationLogo"])}}},[i("svg-circle-plus"),a._v(" "+a._s(a.strings.uploadOrSelectImage)+" ")],1),i("base-button",{staticClass:"remove-image",attrs:{size:"medium",type:"gray"},on:{click:function(t){a.additionalInformation.organizationLogo=null}}},[a._v(" "+a._s(a.strings.remove)+" ")])],1),i("div",{staticClass:"aioseo-description"},[a._v(" "+a._s(a.strings.minimumSize)+" ")]),i("base-img",{attrs:{src:a.additionalInformation.organizationLogo}})],1):a._e(),"organization"!==a.additionalInformation.siteRepresents&&"manual"===a.additionalInformation.person?i("div",{staticClass:"schema-graph-image aioseo-settings-row no-border no-margin"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.logo))])]),i("div",{staticClass:"image-upload"},[i("base-input",{attrs:{size:"medium",placeholder:a.strings.pasteYourImageUrl},model:{value:a.additionalInformation.personLogo,callback:function(t){a.$set(a.additionalInformation,"personLogo",t)},expression:"additionalInformation.personLogo"}}),i("base-button",{staticClass:"insert-image",attrs:{size:"medium",type:"black"},on:{click:function(t){return a.openUploadModal("personLogo",["additionalInformation","personLogo"])}}},[i("svg-circle-plus"),a._v(" "+a._s(a.strings.uploadOrSelectImage)+" ")],1),i("base-button",{staticClass:"remove-image",attrs:{size:"medium",type:"gray"},on:{click:function(t){a.additionalInformation.personLogo=null}}},[a._v(" "+a._s(a.strings.remove)+" ")])],1),i("div",{staticClass:"aioseo-description"},[a._v(" "+a._s(a.strings.minimumSize)+" ")]),i("base-img",{attrs:{src:a.additionalInformation.personLogo}})],1):a._e(),i("div",{staticClass:"schema-graph-image aioseo-settings-row"},[i("div",{staticClass:"settings-name"},[i("div",{staticClass:"name small-margin"},[a._v(a._s(a.strings.defaultSocialShareImage))])]),i("div",{staticClass:"image-upload"},[i("base-input",{attrs:{size:"medium",placeholder:a.strings.pasteYourImageUrl},model:{value:a.additionalInformation.socialShareImage,callback:function(t){a.$set(a.additionalInformation,"socialShareImage",t)},expression:"additionalInformation.socialShareImage"}}),i("base-button",{staticClass:"insert-image",attrs:{size:"medium",type:"black"},on:{click:function(t){return a.openUploadModal("socialShareImage",["additionalInformation","socialShareImage"])}}},[i("svg-circle-plus"),a._v(" "+a._s(a.strings.uploadOrSelectImage)+" ")],1),i("base-button",{staticClass:"remove-image",attrs:{size:"medium",type:"gray"},on:{click:function(t){a.additionalInformation.socialShareImage=null}}},[a._v(" "+a._s(a.strings.remove)+" ")])],1),i("div",{staticClass:"aioseo-description"},[a._v(" "+a._s(a.strings.minimumSize)+" ")]),i("base-img",{attrs:{src:a.additionalInformation.socialShareImage}})],1),i("div",{staticClass:"header social"},[a._v(" "+a._s(a.strings.yourSocialProfiles)+" ")]),a.loaded?i("div",{staticClass:"social-profiles"},[i("core-social-profiles",{attrs:{options:a.additionalInformation,leftSize:"4",rightSize:"8",sameUsernameWidth:"4"}})],1):a._e()],1),i("wizard-close-and-exit")],1)],1)},s=[],o=i("5530"),e=(i("99af"),i("d81d"),i("7db0"),i("9c0e")),r=i("2f62"),l={mixins:[e["i"],e["t"],e["v"]],data:function(){return{loaded:!1,loading:!1,stage:"additional-information",strings:{additionalSiteInformation:this.$t.__("Additional Site Information",this.$td),personOrOrganization:this.$t.__("Person or Organization",this.$td),choosePerson:this.$t.__("Choose a Person",this.$td),person:this.$t.__("Person",this.$td),organization:this.$t.__("Organization",this.$td),personOrOrganizationDescription:this.$t.__("Choose whether the site represents a person or an organization.",this.$td),name:this.$t.__("Name",this.$td),organizationName:this.$t.__("Organization Name",this.$td),phone:this.$t.__("Phone Number",this.$td),chooseContactType:this.$t.__("Choose a Contact Type",this.$td),contactType:this.$t.__("Contact Type",this.$td),contactTypeDescription:this.$t.__("Select which team or department the phone number belongs to.",this.$td),logo:this.$t.__("Logo",this.$td),uploadOrSelectImage:this.$t.__("Upload or Select Image",this.$td),pasteYourImageUrl:this.$t.__("Paste your image URL or select a new image",this.$td),minimumSize:this.$t.__("Minimum size: 112px x 112px, The image must be in JPG, PNG, GIF, SVG, or WEBP format.",this.$td),remove:this.$t.__("Remove",this.$td),defaultSocialShareImage:this.$t.__("Default Social Share Image",this.$td),yourSocialProfiles:this.$t.__("Your Social Profiles",this.$td)}}},computed:Object(o["a"])(Object(o["a"])(Object(o["a"])({},Object(r["e"])(["options"])),Object(r["e"])("wizard",["additionalInformation"])),{},{users:function(){return[{label:this.$t.__("Manually Enter Person",this.$td),value:"manual"}].concat(this.$aioseo.users.map((function(a){return{label:"".concat(a.displayName," (").concat(a.email,")"),gravatar:a.gravatar,value:a.id}})))}}),methods:Object(o["a"])(Object(o["a"])({},Object(r["b"])("wizard",["saveWizard"])),{},{getPersonOptions:function(a){return this.users.find((function(t){return parseInt(t.value)===parseInt(a)}))},getContactTypeOptions:function(a){return this.$constants.CONTACT_TYPES.find((function(t){return t.value===a}))},saveAndContinue:function(){var a=this;this.loading=!0,this.saveWizard("additionalInformation").then((function(){a.$router.push(a.getNextLink)}))}}),mounted:function(){var a=JSON.parse(JSON.stringify(this.options.searchAppearance)),t=JSON.parse(JSON.stringify(this.options.social));this.additionalInformation.social.profiles=JSON.parse(JSON.stringify(t.profiles)),this.additionalInformation.socialShareImage=t.facebook.general.defaultImagePosts,this.additionalInformation.siteRepresents=a.global.schema.siteRepresents,this.additionalInformation.person=a.global.schema.person,this.additionalInformation.organizationName=a.global.schema.organizationName,this.additionalInformation.organizationLogo=a.global.schema.organizationLogo,this.additionalInformation.personName=a.global.schema.personName,this.additionalInformation.personLogo=a.global.schema.personLogo,this.additionalInformation.phone=a.global.schema.phone,this.additionalInformation.contactType=a.global.schema.contactType,this.additionalInformation.contactTypeManual=a.global.schema.contactTypeManual,this.loaded=!0}},d=l,c=(i("dda0"),i("2877")),m=Object(c["a"])(d,n,s,!1,null,null,null);t["default"]=m.exports},dda0:function(a,t,i){"use strict";i("e9ba")},e9ba:function(a,t,i){}}]);