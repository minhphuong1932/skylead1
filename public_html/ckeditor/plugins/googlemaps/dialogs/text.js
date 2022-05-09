﻿
CKEDITOR.dialog.add( 'googlemapsText', function( editor )
{
	"use strict";

	return {
		title : editor.lang.googlemaps.textProperties,
		minWidth : 200,
		minHeight : 35,

		onLoad: function(evt)
		{
			this.setValues = function( data ) { this.definition.setValues.call(this, data); };
			this.getValues = function() { return this.definition.getValues.call(this); };
		},
		setValues : function(data)
		{
			var control = this.getContentElement( 'Info', 'txtTooltip');
			control.setValue( data.title );
			control.setInitValue();
		},

		getValues : function()
		{
			return {
				title: this.getValueOf( 'Info', 'txtTooltip')
			};
		},

		contents : [
			{
				id : 'Info',
				elements :
				[
							{
								id : 'txtTooltip',
								type : 'text'
							}
				]
			}
		]
	};
} );
