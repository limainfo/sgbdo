/*
 * jQuery Mobile Framework : plugin to provide a date and time picker.
 * Copyright (c) JTSage
 * CC 3.0 Attribution.  May be relicensed without permission/notification.
 * https://github.com/jtsage/jquery-mobile-datebox
 */

(function($, undefined ) {
	// We can greatly reduce some operations by adding to the date object.
	Date.prototype.getISO = function () { return String(this.getFullYear()) + '-' + (( this.getMonth() < 9 ) ? "0" : "") + String(this.getMonth()+1) + '-' + ((this.getDate() < 10 ) ? "0" : "") + String(this.getDate()); };
	Date.prototype.getComp = function () { return parseInt(this.getISO().replace(/-/g,''),10); }
	Date.prototype.copy = function() { return this.copymod(); }
	Date.prototype.copymod = function(adj,over) { 
		if ( typeof adj === 'undefined' ) { adj = [0,0,0,0,0,0]; }
		if ( typeof over === 'undefined' ) { over = [0,0,0,0,0,0]; }
		while ( adj.length < 6 ) { adj.push(0); }
		while ( over.length < 6 ) { over.push(0); }
		return new Date(((over[0] > 0 ) ? over[0] : this.getFullYear() + adj[0]),((over[1] > 0 ) ? over[1] : this.getMonth() + adj[1]),((over[2] > 0 ) ? over[2] : this.getDate() + adj[2]),((over[3] > 0 ) ? over[3] : this.getHours() + adj[3]),((over[4] > 0 ) ? over[4] : this.getMinutes() + adj[4]),((over[5] > 0 ) ? over[5] : this.getSeconds() + adj[5]),0);
	}
	Date.prototype.getEpoch = function() { return (this.getTime() - this.getMilliseconds()) / 1000; }
	Date.prototype.adjust = function (type, amount) {
		switch (type) {
			case 'y': this.setFullYear(this.getFullYear() + amount); break;
			case 'm': this.setMonth(this.getMonth() + amount); break;
			case 'd': this.setDate(this.getDate() + amount); break;
			case 'h': this.setHours(this.getHours() + amount); break;
			case 'i': this.setMinutes(this.getMinutes() + amount); break;
			case 's': this.setSeconds(this.getSeconds() + amount); break;
		}
		return this.getTime();
	}
	
  $.widget( "mobile.datebox", $.mobile.widget, {
	options: {
		// All widget options, including some internal runtime details
		version: '1.0.1-2012022700', // jQMMajor.jQMMinor.DBoxMinor-YrMoDaySerial
		theme: false,
		defaultTheme: 'c',
		pickPageTheme: 'b',
		pickPageInputTheme: 'e',
		pickPageButtonTheme: 'a',
		pickPageHighButtonTheme: 'e',
		pickPageOHighButtonTheme: 'e',
		pickPageOAHighButtonTheme: 'e',
		pickPageODHighButtonTheme: 'e',
		pickPageTodayButtonTheme: 'e',
		pickPageSlideButtonTheme: 'd',
		pickPageFlipButtonTheme: 'b',
		forceInheritTheme: false,
		centerWindow: false,
		calHighToday: true,
		calHighPicked: true,
		transition: 'pop',
		noAnimation: false,
		disableManualInput: false,
		
		disabled: false,
		wheelExists: false,
		swipeEnabled: true,
		zindex: '500',
		debug: false,
		clickEvent: 'vclick',
		numberInputEnhance: true,
		internalInputType: 'text',
		resizeListener: true,
		
		titleDialogLabel: false,
		meridiemLetters: ['AM', 'PM'],
		timeOutputOverride: false,
		timeFormats: { '12': '%l:%M %p', '24': '%k:%M' },
		durationFormat: 'DD ddd, hh:ii:ss',
		timeOutput: false,
		rolloverMode: { 'm': true, 'd': true, 'h': true, 'i': true, 's': true },
		
		mode: 'datebox',
		calShowDays: true,
		calShowOnlyMonth: false,
		useDialogForceTrue: false,
		useDialogForceFalse: true,
		fullScreen: false,
		fullScreenAlways: false,
		useDialog: false,
		useModal: false,
		useInline: false,
		useInlineBlind: false,
		useClearButton: false,
		collapseButtons: false,
		noButtonFocusMode: false,
		focusMode: false,
		noButton: false,
		noSetButton: false,
		openCallback: false,
		openCallbackArgs: [],
		closeCallback: false,
		closeCallbackArgs: [],
		open: false,
		nestedBox: false,
		lastDuration: false,
		
		fieldsOrder: false,
		fieldsOrderOverride: false,
		durationOrder: ['d', 'h', 'i', 's'],
		defaultDateFormat: '%Y-%m-%d',
		dateFormat: false,
		timeFormatOverride: false,
		headerFormat: false,
		dateOutput: false,
		minuteStep: 1,
		calTodayButton: false,
		calWeekMode: false,
		calWeekModeFirstDay: 1,
		calWeekModeHighlight: true,
		calStartDay: false,
		defaultPickerValue: false,
		defaultDate : false,    //this is deprecated and will be removed in the future versions (ok, may be not)
		minYear: false,
		maxYear: false,
		afterToday: false,
		beforeToday: false,
		maxDays: false,
		minDays: false,
		highDays: false,
		highDates: false,
		highDatesAlt: false,
		blackDays: false,
		blackDates: false,
		enableDates: false,
		fixDateArrays: false,
		durationSteppers: {'d': 1, 'h': 1, 'i': 1, 's': 1},
		useLang: 'en',
		lang: {
			'en' : {
				setDateButtonLabel: 'Set Date',
				setTimeButtonLabel: 'Set Time',
				setDurationButtonLabel: 'Set Duration',
				calTodayButtonLabel: 'Jump to Today',
				titleDateDialogLabel: 'Set Date',
				titleTimeDialogLabel: 'Set Time',
				daysOfWeek: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
				daysOfWeekShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
				monthsOfYear: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				monthsOfYearShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				durationLabel: ['Days', 'Hours', 'Minutes', 'Seconds'],
				durationDays: ['Day', 'Days'],
				timeFormat: 24,
				headerFormat: '%A, %B %-d, %Y',
				tooltip: 'Open Date Picker',
				nextMonth: 'Next Month',
				prevMonth: 'Previous Month',
				dateFieldOrder: ['m', 'd', 'y'],
				timeFieldOrder: ['h', 'i', 'a'],
				slideFieldOrder: ['y', 'm', 'd'],
				dateFormat: '%Y-%m-%d',
				useArabicIndic: false,
				isRTL: false,
				calStartDay: 0,
				clearButton: 'Clear'
			}
		}
	},
	destroy: function () {
		$(this.pickPage).remove();
		$.Widget.prototype.destroy.call(this);
	},
	_dateboxHandler: function(event, payload) {
		var widget = $(this).data('datebox');
		// Handle all event triggers that have an internal effect
		if ( ! event.isPropagationStopped() ) {
			switch (payload.method) {
				case 'close':
					widget.close(payload.fromCloseButton);
					break;
				case 'open':
					widget.open();
					break;
				case 'set':
					$(this).val(payload.value);
					$(this).trigger('change');
					break;
				case 'doset':
					if ( $.inArray(widget.options.mode, ['timebox', 'durationbox', 'timeflipbox']) > -1 ) {
						$(this).trigger('datebox', {'method':'set', 'value':widget._formatTime(widget.theDate), 'date':widget.theDate});
					} else {
						$(this).trigger('datebox', {'method':'set', 'value':widget._formatDate(widget.theDate), 'date':widget.theDate});
					}
					break;
				case 'dooffset':
					widget._offset(payload.type, payload.amount, true);
					break;
				case 'dorefresh':
					widget._update();
					break;
				case 'doreset':
					widget.hardreset();
					break;
				case 'doclear':
					$(this).val('');
					break;
			}
		} 
	},
	_getCoords: function(widget) {
		var self = widget,
			inputOffset   = widget.focusedEl.offset(),
			inputHigh     = widget.focusedEl.outerHeight(),
			inputWidth    = widget.focusedEl.outerWidth(),
			docWinWidth   = $.mobile.activePage.width(),
			docWinHighOff = $(window).scrollTop(),
			docWinHigh    = $(window).height(),
			diaWinWidth   = widget.pickerContent.innerWidth(),
			diaWinHigh    = widget.pickerContent.outerHeight(),
			pageitem      = false,
			minTop        = 0, // Minimum TOP measurment (absolute)
			padTop        = 0, // Padding for TOP measurment (fixed header)
			unPadBottom   = 0, // Padding for BOTTOM measurement (fixed header)
			maxBottom     = $(document).height(), // Max BOTTOM measurement (absolute)
			
			coords        = {
				'high'    : $(window).height(),
				'width'   : $.mobile.activePage.width(),
				'fullTop' : $(window).scrollTop(),
				'fullLeft': $(window).scrollLeft()
			};
			
		if ( widget.options.centerWindow ) { // If it's centered, no need for lots of checks.
			coords.winTop = docWinHighOff + (( docWinHigh / 2 ) - ( diaWinHigh / 2 ) );
			coords.winLeft = (( docWinWidth / 2 ) - ( diaWinWidth / 2 ) );
		} else {
			pageitem = $('.ui-header', $.mobile.activePage);
			if ( pageitem.length > 0 ) {
				if ( pageitem.is('.ui-header-fixed')) {
					padTop = ( pageitem.outerHeight() + 2 );
				} else {
					minTop += ( pageitem.outerHeight() + 2 );
				}
			}
			pageitem = $('.ui-footer', $.mobile.activePage);
			if ( pageitem.length > 0 ) {
				if ( pageitem.is('.ui-footer-fixed')) {
					unPadBottom = ( pageitem.outerHeight() + 2 );
				} else {
					maxBottom -= ( pageitem.outerHeight() + 2 );
				}
			}
			coords.winLeft = (inputOffset.left + ( inputWidth / 2 )) - ( diaWinWidth / 2 );
			
			// Trap for small screens (center horizontally instead)
			if ( docWinWidth < 450 ) {
				coords.winLeft = (( docWinWidth / 2 ) - ( diaWinWidth / 2 ) );
			}
			
			coords.winTop = (inputOffset.top + ( inputHigh / 2)) - ( diaWinHigh / 2 );
			
			// Not beyond bottom of page or on footer (not fixed)
			if ( (coords.winTop + diaWinHigh) > maxBottom ) {
				coords.winTop += ( maxBottom - ( coords.winTop + diaWinHigh ) );
			}
			
			// Not on the footer either (but only if it floats)
			if ( unPadBottom > 0 && (( coords.winTop + diaWinHigh - docWinHighOff ) > (docWinHigh - unPadBottom)) ) {
				coords.winTop = (( docWinHigh - unPadBottom + docWinHighOff - diaWinHigh ));
			}
			// Not on the header (not fixed)
			if ( coords.winTop < minTop ) { coords.winTop = minTop; }
			
			// Not on the floating header either (fixed)
			if ( padTop > 0 && ( coords.winTop < ( docWinHighOff + padTop ) ) )  {
				coords.winTop = docWinHighOff + padTop;
			} else if ( docWinHighOff > minTop && docWinHighOff > coords.winTop ) {
				// This one for non fixed scroll?
				coords.winTop = docWinHighOff + 2;
			}
				
		}
		return coords;
	},
	_fixArray: function(arr) {
		var x = 0,
			self = this,
			exp = new RegExp('^([0-9]+)-([0-9]+)-([0-9]+)$'),
			matches = null;
		
		if ( $.isArray(arr) ) {
			for ( x=0; x<arr.length; x++) {
				matches = [0];
				matches = exp.exec(arr[x]);
				if ( matches.length === 4 ) {
					arr[x] = matches[1] + '-' + self._zPad(parseInt(matches[2],10)) + '-' + self._zPad(parseInt(matches[3],10));
				}
			}
		}
		return arr;
	},
	_digitReplace: function(oper, direction) {
		var start = 48,
			end = 57,
			adder = 1584,
			i = null, 
			ch = null,
			newd = '';
			
		if ( direction === -1 ) {
			start += adder;
			end += adder;
			adder = -1584;
		}
		
		for ( i=0; i<oper.length; i++ ) {
			ch = oper.charCodeAt(i);
			if ( ch >= start && ch <= end ) {
				newd = newd + String.fromCharCode(ch+adder);
			} else {
				newd = newd + String.fromCharCode(ch);
			}
		}
		
		return newd;
	},
	_makeDisplayIndic: function() {
		var self = this,
			o = this.options;
			
		self.pickerContent.find('*').each(function() {
			if ( $(this).children().length < 1 ) {
				$(this).text(self._digitReplace($(this).text()));
			} else if ( $(this).hasClass('ui-datebox-slideday') ) {
				$(this).html(self._digitReplace($(this).html()));
			}
		});
		self.pickerContent.find('input').each(function() {
			$(this).val(self._digitReplace($(this).val()));
		});
	},
	_zPad: function(number) {
		// Pad a number with a zero, to make it 2 digits
		return ( ( number < 10 ) ? "0" : "" ) + String(number);
	},
	_makeOrd: function (num) {
		// Return an ordinal suffix (1st, 2nd, 3rd, etc)
		var ending = num % 10;
		if ( num > 9 && num < 21 ) { return 'th'; }
		if ( ending > 3 ) { return 'th'; }
		return ['th','st','nd','rd'][ending];
	},
	_isInt: function (s) {
		// Bool, return is a number is an integer
		return (s.toString().search(/^[0-9]+$/) === 0);
	},
	_getFirstDay: function(date) {
		// Get the first DAY of the month (0-6)
		return date.copymod([0],[0,0,1]).getDay();
	},
	_getRecDays: function(year, month, day) {
		// Get the recurring Days of a week for 'year'-'month'
		// (pass nulls for whatever the internal year and month are)
		if ( month === null ) { month = this.theDate.getMonth()+1; }
		if ( year === null ) { year = this.theDate.getFullYear(); }
		
		var self = this,
			tempDate = new Date(year, month-1, 1, 0, 0, 0, 0),
			dates = [], i;
		
		if ( tempDate.getDay() > day ) {
			tempDate.setDate(8 - (tempDate.getDay() - day));
		} else if ( tempDate.getDay() < day ) {
			tempDate.setDate(1 + (day - tempDate.getDay()));
		}
		
		dates[0] = tempDate.getISO();
		
		for ( i = 1; i<6; i++ ) {
			tempDate.setDate(tempDate.getDate() + 7);
			if ( (tempDate.getMonth()+1) === month ) {
				dates[i] = tempDate.getISO();
			}
		}
		
		return dates;
	},
	_getLastDate: function(date) {
		// Get the last DATE of the month (28,29,30,31)
		return 32 - date.copymod([0],[0,0,32,13]).getDate();
	},
	_getLastDateBefore: function(date) {
		// Get the last DATE of the PREVIOUS month (28,29,30,31)
		return 32 - date.copymod([0,-1],[0,0,32,13]).getDate();
	},
	_formatter: function(format, date) {
		var self = this,
			o = this.options;
		// Format the output date or time (not duration)
		if ( ! format.match(/%/) ) {
			format = format.replace('HH',   this._zPad(date.getHours()));
			format = format.replace('GG',   date.getHours());
			
			format = format.replace('hh',   this._zPad(((date.getHours() === 0 || date.getHours() === 12)?12:((date.getHours()<12)?date.getHours():date.getHours()-12))));
			format = format.replace('gg',   ((date.getHours() === 0 || date.getHours() === 12)?12:((date.getHours()<12)?date.getHours():(date.getHours()-12))));
	
			format = format.replace('ii',   this._zPad(date.getMinutes()));
			format = format.replace('ss',   this._zPad(date.getSeconds()));
			format = format.replace('AA',   ((date.getHours() < 12)?this.options.meridiemLetters[0].toUpperCase():this.options.meridiemLetters[1].toUpperCase()));
			format = format.replace('aa',   ((date.getHours() < 12)?this.options.meridiemLetters[0].toLowerCase():this.options.meridiemLetters[1].toLowerCase()));
			
			format = format.replace('SS',   this._makeOrd(date.getDate()));
			format = format.replace('YYYY', date.getFullYear());
			format = format.replace('mmmm', this.options.lang[this.options.useLang].monthsOfYearShort[date.getMonth()] );
			format = format.replace('mmm',  this.options.lang[this.options.useLang].monthsOfYear[date.getMonth()] );
			format = format.replace('MM',   this._zPad(date.getMonth() + 1));
			format = format.replace('mm',   date.getMonth() + 1);
			format = format.replace('dddd', this.options.lang[this.options.useLang].daysOfWeekShort[date.getDay()] );
			format = format.replace('ddd',  this.options.lang[this.options.useLang].daysOfWeek[date.getDay()] );
			format = format.replace('DD',   this._zPad(date.getDate()));
			format = format.replace('dd',   date.getDate());
			format = format.replace('UU',   date.getEpoch());
		} else {
			format = format.replace(/%(0|-)*([a-z])/gi, function(match, pad, oper, offset, s) {
				switch ( oper ) {
					case '%': // Literal %
						return '%';
					case 'a': // Short Day
						return o.lang[o.useLang].daysOfWeekShort[date.getDay()];
					case 'A': // Full Day of week
						return o.lang[o.useLang].daysOfWeek[date.getDay()];
					case 'b': // Short month
						return o.lang[o.useLang].monthsOfYearShort[date.getMonth()];
					case 'B': // Full month
						return o.lang[o.useLang].monthsOfYear[date.getMonth()];
					case 'C': // Century
						return date.getFullYear().toString().substr(0,2);
					case 'd': // Day of month
						return (( pad === '-' ) ? date.getDate() : self._zPad(date.getDate()));
					case 'H': // Hour (01..23)
					case 'k':
						return (( pad === '-' ) ? date.getHours() : self._zPad(date.getHours()));
					case 'I': // Hour (01..12)
					case 'l':
						return (( pad === '-' ) ? ((date.getHours() === 0 || date.getHours() === 12)?12:((date.getHours()<12)?date.getHours():(date.getHours()-12))) : self._zPad(((date.getHours() === 0 || date.getHours() === 12)?12:((date.getHours()<12)?date.getHours():date.getHours()-12))));
					case 'm': // Month
						return (( pad === '-' ) ? date.getMonth()+1 : self._zPad(date.getMonth()+1));
					case 'M': // Minutes
						return (( pad === '-' ) ? date.getMinutes() : self._zPad(date.getMinutes()));
					case 'p': // AM/PM (ucase)
						return ((date.getHours() < 12)?o.meridiemLetters[0].toUpperCase():o.meridiemLetters[1].toUpperCase());
					case 'P': // AM/PM (lcase)
						return ((date.getHours() < 12)?o.meridiemLetters[0].toLowerCase():o.meridiemLetters[1].toLowerCase());
					case 's': // Unix Seconds
						return date.getEpoch;
					case 'S': // Seconds
						return (( pad === '-' ) ? date.getSeconds() : self._zPad(date.getSeconds()));
					case 'w': // Day of week
						return date.getDay();
					case 'y': // Year (2 digit)
						return date.getFullYear().toString().substr(2,2);
					case 'Y': // Year (4 digit)
						return date.getFullYear();
					case 'o': // Ordinals
						return self._makeOrd(date.getDate());
					default:
						return match;
				}
			});
		}
		
		if ( this.options.lang[this.options.useLang].useArabicIndic === true ) {
			format = this._digitReplace(format);
		}
		
		return format;
	},
	_formatHeader: function(date) {
		// Shortcut function to return headerFormat date/time format
		if ( this.options.headerFormat !== false ) {
			return this._formatter(this.options.headerFormat, date);
		} else {
			return this._formatter(this.options.lang[this.options.useLang].headerFormat, date);
		}
	},
	_formatDate: function(date) {
		// Shortcut function to return dateFormat date/time format
		return this._formatter(this.options.dateOutput, date);
	},
	_formatTime: function(date) {
		// Shortcut to return formatted time, also handles duration
		var self = this,
			dur_collapse = [false,false,false], adv, exp_format, i, j,
			format = this.options.durationFormat,
			dur_comps = [0,0,0,0];
			
		if ( this.options.mode === 'durationbox' ) {
			adv = this.options.durationFormat;
			adv = adv.replace(/ddd/g, '.+?');
			adv = adv.replace(/DD|ss|hh|ii/g, '([0-9Dhis]+)');
			adv = new RegExp('^' + adv + '$');
			exp_format = adv.exec(this.options.durationFormat);
			
			i = self.theDate.getEpoch() - self.initDate.getEpoch(); j = i;
			
			dur_comps[0] = parseInt( i / (60*60*24),10); i = i - (dur_comps[0]*60*60*24); // Days
			dur_comps[1] = parseInt( i / (60*60),10); i = i - (dur_comps[1]*60*60); // Hours
			dur_comps[2] = parseInt( i / (60),10); i = i - (dur_comps[2]*60); // Minutes
			dur_comps[3] = i; // Seconds
			
			if ( ! exp_format[0].match(/DD/) ) { dur_collapse[0] = true; dur_comps[1] = dur_comps[1] + (dur_comps[0]*24);}
			if ( ! exp_format[0].match(/hh/) ) { dur_collapse[1] = true; dur_comps[2] = dur_comps[2] + (dur_comps[1]*60);}
			if ( ! exp_format[0].match(/ii/) ) { dur_collapse[2] = true; dur_comps[3] = dur_comps[3] + (dur_comps[2]*60);}
			
			format = format.replace('DD', dur_comps[0]);
			format = format.replace('ddd', ((dur_comps[0] > 1)?this.options.lang[this.options.useLang].durationDays[1]:this.options.lang[this.options.useLang].durationDays[0]));
			format = format.replace('hh', self._zPad(dur_comps[1]));
			format = format.replace('ii', self._zPad(dur_comps[2]));
			format = format.replace('ss', self._zPad(dur_comps[3]));
			
			if ( this.options.lang[this.options.useLang].useArabicIndic === true ) {
				return this._digitReplace(format);
			} else {
				return format;
			}
		} else {
			return this._formatter(self.options.timeOutput, date);
		}
	},
	_makeDate: function (str) {
		// Date Parser
		str = $.trim(str);
		var o = this.options,
			self = this,
			adv = null,
			exp_input = null,
			exp_format = null,
			exp_temp = null,
			date = new Date(),
			dur_collapse = [false,false,false],
			found_date = [date.getFullYear(),date.getMonth(),date.getDate(),date.getHours(),date.getMinutes(),date.getSeconds(),0],
			i;
			
		if ( o.lang[this.options.useLang].useArabicIndic === true ) {
			str = this._digitReplace(str, -1);
		}

		if ( o.mode === 'durationbox' ) {
			adv = o.durationFormat;
			adv = adv.replace(/ddd/g, '.+?');
			adv = adv.replace(/DD|ss|hh|ii/g, '([0-9Dhis]+)');
			adv = new RegExp('^' + adv + '$');
			exp_input = adv.exec(str);
			exp_format = adv.exec(o.durationFormat);
			
			if ( exp_input === null || exp_input.length !== exp_format.length ) {
				if ( typeof o.defaultPickerValue === "number" && o.defaultPickerValue > 0 ) {
					return new Date((self.initDate.getEpoch() + parseInt(o.defaultPickerValue,10))*1000);
				} else {
					return new Date(self.initDate.getTime());
				}
			} else {
				exp_temp = self.initDate.getEpoch();
				for ( i=0; i<exp_input.length; i++ ) { //0y 1m 2d 3h 4i 5s
					if ( exp_format[i].match(/^DD$/i) )   { exp_temp = exp_temp + (parseInt(exp_input[i],10)*60*60*24); }
					if ( exp_format[i].match(/^hh$/i) )   { exp_temp = exp_temp + (parseInt(exp_input[i],10)*60*60); }
					if ( exp_format[i].match(/^ii$/i) )   { exp_temp = exp_temp + (parseInt(exp_input[i],10)*60); }
					if ( exp_format[i].match(/^ss$/i) )   { exp_temp = exp_temp + (parseInt(exp_input[i],10)); }
				}
				return new Date((exp_temp*1000));
			}
		} else {
			if ( o.mode === 'timebox' || o.mode === 'timeflipbox' ) { adv = o.timeOutput; } else { adv = o.dateOutput; }
			if ( adv.match(/%/) ) {
				adv = adv.replace(/%(0|-)*([a-z])/gi, function(match, pad, oper, offset, s) {
					switch (oper) {
						case 'p':
						case 'P':
						case 'b':
						case 'B': return '(' + match + '|' +'.+?' + ')';
						case 'H':
						case 'k':
						case 'I':
						case 'l':
						case 'm':
						case 'M':
						case 'S':
						case 'd': return '(' + match + '|' + (( pad === '-' ) ? '[0-9]{1,2}' : '[0-9]{2}') + ')';
						case 's': return '(' + match + '|' +'[0-9]+' + ')';
						case 'y': return '(' + match + '|' +'[0-9]{2}' + ')';
						case 'Y': return '(' + match + '|' +'[0-9]{1,4}' + ')';
						default: return '.+?';
					}
				});
				adv = new RegExp('^' + adv + '$');
				exp_input = adv.exec(str);
				if ( o.mode === 'timebox' || o.mode === 'timeflipbox' ) {
					exp_format = adv.exec(o.timeOutput); // If time, use timeOutput as expected format
				} else {
					exp_format = adv.exec(o.dateOutput); // If date, use dateFormat as expected format
				}
				
				if ( exp_input === null || exp_input.length !== exp_format.length ) {
					if ( o.defaultPickerValue !== false ) {
						if ( $.isArray(o.defaultPickerValue) && o.defaultPickerValue.length === 3 ) {
							if ( o.mode === 'timebox' || o.mode === 'timeflipbox' ) {
								return new Date(found_date[0], found_date[1], found_date[2], o.defaultPickerValue[0], o.defaultPickerValue[1], o.defaultPickerValue[2], 0);
							}
							else {
								return new Date(o.defaultPickerValue[0], o.defaultPickerValue[1], o.defaultPickerValue[2], 0, 0, 0, 0);
							}
						}
						else if ( typeof o.defaultPickerValue === "number" ) {
							return new Date(o.defaultPickerValue * 1000);
						}
						else {
							if ( o.mode === 'timebox' || o.mode === 'timeflipbox' ) {
								exp_temp = o.defaultPickerValue.split(':');
								if ( exp_temp.length === 3 ) {
									date = new Date(found_date[0], found_date[1], found_date[2], parseInt(exp_temp[0],10),parseInt(exp_temp[1],10),parseInt(exp_temp[2],10),0);
									if ( isNaN(date.getDate()) ) { date = new Date(); }
								}
							}
							else {
								exp_temp = o.defaultPickerValue.split('-');
								if ( exp_temp.length === 3 ) {
									date = new Date(parseInt(exp_temp[0],10),parseInt(exp_temp[1],10)-1,parseInt(exp_temp[2],10),0,0,0,0);
									if ( isNaN(date.getDate()) ) { date = new Date(); }
								}
							}
						}
					}
				} else {
					for ( i=0; i<exp_input.length; i++ ) { //0y 1m 2d 3h 4i 5a 6epoch
						if ( exp_format[i] === '%s' )                { found_date[6] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^%.*S$/) )         { found_date[5] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^%.*M$/) )         { found_date[4] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^%.*(H|k|I|l)$/) ) { found_date[3] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^%.*d$/) )         { found_date[2] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^%.*m$/) )         { found_date[1] = parseInt(exp_input[i],10)-1; }
						if ( exp_format[i].match(/^%.*Y$/) )         { found_date[0] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^%.*y$/) ) { 
							if ( o.afterToday === true ) {
								found_date[0] = parseInt('20' + exp_input[i],10);
							} else {
								if ( parseInt(exp_input[i],10) < 38 ) {
									found_date[0] = parseInt('20' + exp_input[i],10);
								} else {
									found_date[0] = parseInt('19' + exp_input[i],10);
								}
							}
						}
						if ( exp_format[i].match(/^%(0|-)*(p|P)$/) ) {
							if ( exp_input[i].toLowerCase().charAt(0) === 'a' && found_date[3] === 12 ) {
								found_date[3] = 0;
							} else if ( exp_input[i].toLowerCase().charAt(0) === 'p' && found_date[3] !== 12 ) {
								found_date[3] = found_date[3] + 12;
							}
						}
						if ( exp_format[i] === '%B' ) {
							exp_temp = $.inArray(exp_input[i], o.lang[o.useLang].monthsOfYear);
							if ( exp_temp > -1 ) { found_date[1] = exp_temp; }
						}
						if ( exp_format[i] === '%b' ) {
							exp_temp = $.inArray(exp_input[i], o.lang[o.useLang].monthsOfYearShort);
							if ( exp_temp > -1 ) { found_date[1] = exp_temp; }
						}
					}
				}
				if ( exp_format[0].match(/%s/) ) {
					date = new Date(found_date[6] * 1000);
				}
				else if ( exp_format[0].match(/%(.)*(I|l|H|k|s|M)/) ) { 
					date = new Date(found_date[0], found_date[1], found_date[2], found_date[3], found_date[4], found_date[5], 0);
					if ( found_date[0] < 100 ) { date.setFullYear(found_date[0]); }
				} else {
					date = new Date(found_date[0], found_date[1], found_date[2], 0, 0, 0, 0); // Normalize time for raw dates
					if ( found_date[0] < 100 ) { date.setFullYear(found_date[0]); }
				}
				return date;
			} else {
				adv = adv.replace(/dddd|mmmm/g, '(.+?)');
				adv = adv.replace(/ddd|SS/g, '.+?');
				adv = adv.replace(/mmm/g, '(.+?)');
				adv = adv.replace(/ *AA/ig, ' *(.*?)');
				adv = adv.replace(/yyyy|dd|mm|gg|hh|ii/ig, '([0-9yYdDmMgGhHi]+)');
				adv = adv.replace(/ss|UU/g, '([0-9sU]+)');
				adv = new RegExp('^' + adv + '$');
				exp_input = adv.exec(str);
				if ( o.mode === 'timebox' || o.mode === 'timeflipbox' ) {
					exp_format = adv.exec(o.timeOutput); // If time, use timeOutput as expected format
				} else {
					exp_format = adv.exec(o.dateOutput); // If date, use dateFormat as expected format
				}
				
				if ( exp_input === null || exp_input.length !== exp_format.length ) {
					if ( o.defaultPickerValue !== false ) {
						if ( $.isArray(o.defaultPickerValue) && o.defaultPickerValue.length === 3 ) {
							if ( o.mode === 'timebox' || o.mode === 'timeflipbox' ) {
								return new Date(found_date[0], found_date[1], found_date[2], o.defaultPickerValue[0], o.defaultPickerValue[1], o.defaultPickerValue[2], 0);
							}
							else {
								return new Date(o.defaultPickerValue[0], o.defaultPickerValue[1], o.defaultPickerValue[2], 0, 0, 0, 0);
							}
						}
						else if ( typeof o.defaultPickerValue === "number" ) {
							return new Date(o.defaultPickerValue * 1000);
						}
						else {
							if ( o.mode === 'timebox' || o.mode === 'timeflipbox' ) {
								exp_temp = o.defaultPickerValue.split(':');
								if ( exp_temp.length === 3 ) {
									date = new Date(found_date[0], found_date[1], found_date[2], parseInt(exp_temp[0],10),parseInt(exp_temp[1],10),parseInt(exp_temp[2],10),0);
									if ( isNaN(date.getDate()) ) { date = new Date(); }
								}
							}
							else {
								exp_temp = o.defaultPickerValue.split('-');
								if ( exp_temp.length === 3 ) {
									date = new Date(parseInt(exp_temp[0],10),parseInt(exp_temp[1],10)-1,parseInt(exp_temp[2],10),0,0,0,0);
									if ( isNaN(date.getDate()) ) { date = new Date(); }
								}
							}
						}
					}
				} else {
					for ( i=0; i<exp_input.length; i++ ) { //0y 1m 2d 3h 4i 5a 6epoch
						if ( exp_format[i].match(/^UU$/ ) )   { found_date[6] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^gg$/i) )   { found_date[3] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^hh$/i) )   { found_date[3] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^ii$/i) )   { found_date[4] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^ss$/ ) )   { found_date[5] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^dd$/i) )   { found_date[2] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^mm$/i) )   { found_date[1] = parseInt(exp_input[i],10)-1; }
						if ( exp_format[i].match(/^yyyy$/i) ) { found_date[0] = parseInt(exp_input[i],10); }
						if ( exp_format[i].match(/^AA$/i) )   { 
							if ( exp_input[i].toLowerCase().charAt(0) === 'a' && found_date[3] === 12 ) {
								found_date[3] = 0;
							} else if ( exp_input[i].toLowerCase().charAt(0) === 'p' && found_date[3] !== 12 ) {
								found_date[3] = found_date[3] + 12;
							}
						}
						if ( exp_format[i].match(/^mmm$/i) )  { 
							exp_temp = $.inArray(exp_input[i], o.lang[o.useLang].monthsOfYear);
							if ( exp_temp > -1 ) { found_date[1] = exp_temp; }
						}
						if ( exp_format[i].match(/^mmmm$/i) )  { 
							exp_temp = $.inArray(exp_input[i], o.lang[o.useLang].monthsOfYearShort);
							if ( exp_temp > -1 ) { found_date[1] = exp_temp; }
						}
					}
				}
				if ( exp_format[0].match(/UU/) ) {
					return new Date(found_date[6] * 1000);
				}
				else if ( exp_format[0].match(/G|g|i|s|H|h|A/) ) { 
					return new Date(found_date[0], found_date[1], found_date[2], found_date[3], found_date[4], found_date[5], 0);
				} else {
					return new Date(found_date[0], found_date[1], found_date[2], 0, 0, 0, 0); // Normalize time for raw dates
				}
			}
		}
	},
	_hoover: function(item) {
		// Hover toggle class, for calendar
		$(item).toggleClass('ui-btn-up-'+$(item).jqmData('theme')+' ui-btn-down-'+$(item).jqmData('theme'));
	},
	_offset: function(mode, amount, update) {
		// Compute a date/time offset.
		//   update = false to prevent controls refresh
		var self = this,
			o = this.options,
			ok = false;
			
		if ( typeof(update) === "undefined" ) { update = true; }
		self.input.trigger('datebox', {'method':'offset', 'type':mode, 'amount':amount});
		switch(mode) {
			case 'y': ok = true; break;
			case 'm':
				if ( o.rolloverMode.m || ( self.theDate.getMonth() + amount < 12 && self.theDate.getMonth() + amount > -1 ) ) {
					ok = true;
				}
				break;
			case 'd':
				if ( o.rolloverMode.d || (
					self.theDate.getDate() + amount > 0 &&
					self.theDate.getDate() + amount < (self._getLastDate(self.theDate) + 1) ) ) {
						ok = true;
				}
				break;
			case 'h':
				if ( o.rolloverMode.h || (
					self.theDate.getHours() + amount > -1 &&
					self.theDate.getHours() + amount < 24 ) ) {
						ok = true;
				}
				break;
			case 'i':
				if ( o.rolloverMode.i || (
					self.theDate.getMinutes() + amount > -1 &&
					self.theDate.getMinutes() + amount < 60 ) ) {
						ok = true;
				}
				break;
			case 's':
				if ( o.rolloverMode.s || (
					self.theDate.getSeconds() + amount > -1 &&
					self.theDate.getSeconds() + amount < 60 ) ) {
						ok = true;
				}
				break;
			case 'a':
				if ( self.pickerMeri.val() === o.meridiemLetters[0] ) { 
					self._offset('h',12,false);
				} else {
					self._offset('h',-12,false);
				}
				break;
		}
		if ( ok === true ) { self.theDate.adjust(mode,amount); }
		if ( update === true ) { self._update(); }
	},
	_updateduration: function() {
		// Update the duration contols when inputs are directly edited.
		var self = this,
			secs = self.initDate.getEpoch();
		
		if ( !self._isInt(self.pickerDay.val())  ) { self.pickerDay.val(0); }
		if ( !self._isInt(self.pickerHour.val()) ) { self.pickerHour.val(0); }
		if ( !self._isInt(self.pickerMins.val()) ) { self.pickerMins.val(0); }
		if ( !self._isInt(self.pickerSecs.val()) ) { self.pickerSecs.val(0); }
		
		secs = secs + (parseInt(self.pickerDay.val(),10) * 60 * 60 * 24);
		secs = secs + (parseInt(self.pickerHour.val(),10) * 60 * 60);
		secs = secs + (parseInt(self.pickerMins.val(),10) * 60);
		secs = secs + (parseInt(self.pickerSecs.val(),10));
		self.theDate.setTime( secs * 1000 );
		self._update();
	},
	_checkConstraints: function() {
		var self = this,
			testDate = null,
			o = this.options;
		
		self.dateOK = true;
		
		if ( o.afterToday !== false ) {
			testDate = new Date();
			if ( self.theDate < testDate ) { self.theDate = testDate; }
		}
		if ( o.beforeToday !== false ) {
			testDate = new Date();
			if ( self.theDate > testDate ) { self.theDate = testDate; }
		}
		if ( o.maxDays !== false ) {
			testDate = new Date();
			testDate.adjust('d', o.maxDays);
			if ( self.theDate > testDate ) { self.theDate = testDate; }
		}
		if ( o.minDays !== false ) {
			testDate = new Date();
			testDate.adjust('d', -1*o.minDays);
			if ( self.theDate < testDate ) { self.theDate = testDate; }
		}
		if ( o.maxYear !== false ) {
			testDate = new Date(o.maxYear, 0, 1);
			testDate.adjust('d', -1);
			if ( self.theDate > testDate ) { self.theDate = testDate; }
		}
		if ( o.minYear !== false ) {
			testDate = new Date(o.minYear, 0, 1);
			if ( self.theDate < testDate ) { self.theDate = testDate; }
		}
		if ( o.blackDates !== false ) {
			if ( $.inArray(self.theDate.getISO(), o.blackDates) > -1 ) { self.dateOK = false; }
		}
		if ( o.blackDays !== false ) {
			if ( $.inArray(self.theDate.getDay(), o.blackDays) > -1 ) { self.dateOK = false; }
		}
		if ( $.inArray(o.mode, ['timebox','durationbox','timeflipbox']) > -1 ) { self.dateOK = true; }
	},
	_orientChange: function(e) {
		var self = e.data.widget,
			o = e.data.widget.options,
			coords = e.data.widget._getCoords(e.data.widget); // Get the coords now, since we need em.
		
		e.stopPropagation();
		if ( ! self.pickerContent.is(':visible') || o.useDialog === true ) { 
			return false;  // Not open, or in a dialog (let jQM do it)
		} else {
			if ( o.fullScreen == true && ( coords.width < 400 || o.fullScreenForce === true ) ) {
				self.pickerContent.css({'top': coords.fullTop, 'left': coords.fullLeft, 'height': coords.high, 'width': coords.width, 'maxWidth': coords.width });
			} else {
				self.pickerContent.css({'top': coords.winTop, 'left': coords.winLeft});
			}
		}
	},
	_update: function() {
		// Update the display on date change
		var self = this,
			o = self.options, 
			testDate = null,
			i, gridWeek, gridDay, skipThis, thisRow, y, cTheme, inheritDate, thisPRow, tmpVal, disVal,
			interval = {'d': 60*60*24, 'h': 60*60, 'i': 60, 's':1},
			calmode = {};
			
		self.input.trigger('datebox', {'method':'refresh'});
		/* CLIP:DURATIONBOX */
		/* BEGIN:TIMEBOX */
		if ( o.mode === 'timebox' ) {
			if ( o.minuteStep !== 1 ) {
				i = self.theDate.getMinutes() % o.minuteStep;
				if ( i !== 0 ) { self.theDate.adjust('m', -1*i); }
			}
			self.pickerMins.val(self._zPad(self.theDate.getMinutes()));
			if ( o.lang[o.useLang].timeFormat === 12 || o.timeFormatOverride === 12 ) { // Handle meridiems
				if ( self.theDate.getHours() > 11 ) {
					self.pickerMeri.val(o.meridiemLetters[1]);
					if ( self.theDate.getHours() === 12 ) {
						self.pickerHour.val(12);
					} else {
						self.pickerHour.val(self.theDate.getHours() - 12);
					}
				} else {
					self.pickerMeri.val(o.meridiemLetters[0]);
					if ( self.theDate.getHours() === 0 ) {
						self.pickerHour.val(12);
					} else {
						self.pickerHour.val(self.theDate.getHours());
					}
				}
			} else {
				self.pickerHour.val(self.theDate.getHours());
			}
		}
		/* END:TIMEBOX */
		/* CLIP:FLIPBOX */
		/* CLIP:SLIDEBOX */
		/* CLIP:DATEBOX */
		/* CLIP:CALBOX */
		
		if ( o.lang[this.options.useLang].useArabicIndic === true ) {
			self._makeDisplayIndic();
		}
	},
	_getLongOptions: function(element) {
		var key, retty = {}, prefix, temp;
		
		if ( $.mobile.ns == "" ) { 
			prefix = "datebox";
		} else { 
			prefix = $.mobile.ns.substr(0, $.mobile.ns.length - 1) + 'Datebox';
		}
		
		for ( key in element.data() ) {
			if ( key.substr(0, prefix.length) === prefix && key.length > prefix.length ) {
				temp = key.substr(prefix.length);
				temp = temp.charAt(0).toLowerCase() + temp.slice(1);
				retty[temp] = element.data(key);
			}
		}
		return retty;
	},
	_create: function() {
		// Create the widget, called automatically by widget system
		
		// Trigger dateboxcreate
		$( document ).trigger( "dateboxcreate" );
		
		var self = this,
			o = $.extend(this.options, this.element.jqmData('options')),
			o = ((typeof this.element.jqmData('options') === 'undefined') ? $.extend(o, this._getLongOptions(this.element)) : o);
			input = this.element,
			thisTheme = ( o.theme === false && typeof($(self).jqmData('theme')) === 'undefined' ) ?
				( ( typeof(input.parentsUntil(':jqmData(theme)').parent().jqmData('theme')) === 'undefined' ) ?
					o.defaultTheme : input.parentsUntil(':jqmData(theme)').parent().jqmData('theme') )
				: o.theme,
			focusedEl = input.wrap('<div class="ui-input-datebox ui-shadow-inset ui-corner-all ui-body-'+ thisTheme +'"></div>').parent(),
			theDate = new Date(), // Internal date object, used for all operations
			initDate = new Date(theDate.getTime()), // Initilization time - used for duration
			
			// This is the button that is added to the original input
			openbutton = $('<a href="#" class="ui-input-clear" title="'+((typeof o.lang[o.useLang].tooltip !== 'undefined')?o.lang[o.useLang].tooltip:o.lang.en.tooltip)+'">'+((typeof o.lang[o.useLang].tooltip !== 'undefined')?o.lang[o.useLang].tooltip:o.lang.en.tooltip)+'</a>')
				.bind(o.clickEvent, function (e) {
					e.preventDefault();
					if ( !o.disabled ) { self.input.trigger('datebox', {'method': 'open'}); self.focusedEl.addClass('ui-focus'); }
					setTimeout( function() { $(e.target).closest("a").removeClass($.mobile.activeBtnClass); }, 300);
				})
				.appendTo(focusedEl).buttonMarkup({icon: 'grid', iconpos: 'notext', corners:true, shadow:true})
				.css({'vertical-align': 'middle', 'display': 'inline-block'}),
			thisPage = input.closest('.ui-page'),
			ns = (typeof $.mobile.ns !== 'undefined')?$.mobile.ns:'',
			pickPage = $("<div data-"+ns+"role='dialog' class='ui-dialog-datebox' data-"+ns+"theme='" + ((o.forceInheritTheme === false ) ? o.pickPageTheme : thisTheme ) + "' >" +
						"<div data-"+ns+"role='header' data-"+ns+"backbtn='false' data-"+ns+"theme='a'>" +
							"<div class='ui-title'>PlaceHolder</div>"+
						"</div>"+
						"<div data-"+ns+"role='content'></div>"+
					"</div>")
					.appendTo( $.mobile.pageContainer )
					.page().css('minHeight', '0px').css('zIndex', o.zindex).addClass(o.transition),
			pickPageTitle = pickPage.find('.ui-title'),
			pickPageContent = pickPage.find( ".ui-content" ),
			touch = ( typeof window.ontouchstart !== 'undefined' ),
			START_EVENT = touch ? 'touchstart' : 'mousedown',
			MOVE_EVENT = touch ? 'touchmove' : 'mousemove',
			END_EVENT = touch ? 'touchend' : 'mouseup',
			dragMove = false,
			dragStart = false,
			dragEnd = false,
			dragPos = false,
			dragTarget = false,
			dragThisDelta = 0;
		
		o.theme = thisTheme;
		
		$.extend(self, {
			input: input,
			focusedEl: focusedEl });
		
		if ( o.forceInheritTheme ) {
			o.pickPageTheme = thisTheme;
			o.pickPageInputTheme = thisTheme;
			o.pickPageButtonTheme = thisTheme;
		}
		
		if ( o.defaultPickerValue===false && o.defaultDate!==false ) {
			o.defaultPickerValue = o.defaultDate;
		}
		
		if ( o.numberInputEnhance === true ) {
			if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i) ){
				o.internalInputType = 'number';
			}
		}
		
		$('label[for=\''+input.attr('id')+'\']').addClass('ui-input-text').css('verticalAlign', 'middle');

		o.mode = 'timebox'
		
		if ( o.mode === "timeflipbox" ) { // No header in time flipbox.
			o.lang[o.useLang].headerFormat = ' ';
		}
		
		// For focus mode, disable button, and bind click of input element and it's parent	
		if ( o.noButtonFocusMode || o.useInline || o.noButton ) { openbutton.hide(); }
		
		self.focusedEl.bind(o.clickEvent, function() {
			if ( !o.disabled && ( o.noButtonFocusMode || o.focusMode ) ) { 
				self.input.trigger('datebox', {'method': 'open'});
				self.focusedEl.addClass('ui-focus');
				self.input.removeClass('ui-focus');
			}
		});
		
		
		self.input
			.removeClass('ui-corner-all ui-shadow-inset')
			.focus(function(){
				if ( ! o.disabled ) {
					self.focusedEl.addClass('ui-focus');
				}
				self.input.removeClass('ui-focus');
			})
			.blur(function(){
				self.focusedEl.removeClass('ui-focus');
				self.input.removeClass('ui-focus');
			})
			.change(function() {
				self.theDate = self._makeDate(self.input.val());
				self._update();
			});
			
		// Bind the master handler.
		self.input.bind('datebox', self._dateboxHandler);
		
		// Bind the close button on the DIALOG mode. (after unbinding the default)
		pickPage.find( ".ui-header a").unbind('click vclick').bind(o.clickEvent, function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			self.input.trigger('datebox', {'method':'close', 'fromCloseButton':false});
		});

		$.extend(self, {
			pickPage: pickPage,
			thisPage: thisPage,
			pickPageContent: pickPageContent,
			pickPageTitle: pickPageTitle,
			theDate: theDate,
			initDate: initDate,
			touch: touch,
			START_DRAG: START_EVENT,
			MOVE_DRAG: MOVE_EVENT,
			END_DRAG: END_EVENT,
			dragMove: dragMove,
			dragStart: dragStart,
			dragEnd: dragEnd,
			dragPos: dragPos
		});
		
		// Check if mousewheel plugin is loaded
		if ( typeof $.event.special.mousewheel !== 'undefined' ) { o.wheelExists = true; }
		
		self._buildPage();
		
		// drag and drop support, all ending and moving events are defined here, start events are handled in _buildPage or update
		if ( o.swipeEnabled ) {
			$(document).bind(self.MOVE_DRAG, function(e) {
				if ( self.dragMove ) {
					if ( o.mode === 'slidebox' ) {
						self.dragEnd = self.touch ? e.originalEvent.changedTouches[0].pageX : e.pageX;
						self.dragTarget.css('marginLeft', (self.dragPos + self.dragEnd - self.dragStart) + 'px');
						e.preventDefault();
						e.stopPropagation();
						return false;
					} else if ( o.mode === 'flipbox' || o.mode === 'timeflipbox' ) {
						self.dragEnd = self.touch ? e.originalEvent.changedTouches[0].pageY : e.pageY;
						self.dragTarget.css('marginTop', (self.dragPos + self.dragEnd - self.dragStart) + 'px');
						e.preventDefault();
						e.stopPropagation();
						return false;
					} else if ( o.mode === 'durationbox' || o.mode === 'timebox' || o.mode === 'datebox' ) {
						self.dragEnd = self.touch ? e.originalEvent.changedTouches[0].pageY : e.pageY;
						if ( (self.dragEnd - self.dragStart) % 2 === 0 ) {
							dragThisDelta = (self.dragEnd - self.dragStart) / -2;
							if ( dragThisDelta < self.dragPos ) {
								self._offset(self.dragTarget, -1*(self.dragTarget==='i'?o.minuteStep:1));
							} else if ( dragThisDelta > self.dragPos ) {
								self._offset(self.dragTarget, (self.dragTarget==='i'?o.minuteStep:1));
							} 
							self.dragPos = dragThisDelta;
						}
						e.preventDefault();
						e.stopPropagation();
						return false;
					}
				} 
			});
			$(document).bind(self.END_DRAG, function(e) {
				if ( self.dragMove ) {
					self.dragMove = false;
					if ( o.mode === 'slidebox' ) {
						if ( self.dragEnd !== false && Math.abs(self.dragStart - self.dragEnd) > 25 ) {
							e.preventDefault();
							e.stopPropagation();
							switch(self.dragTarget.parent().jqmData('rowtype')) {
								case 'y':
									self._offset('y', parseInt(( self.dragStart - self.dragEnd ) / 84, 10));
									break;
								case 'm':
									self._offset('m', parseInt(( self.dragStart - self.dragEnd ) / 51, 10));
									break;
								case 'd':
									self._offset('d', parseInt(( self.dragStart - self.dragEnd ) / 32, 10));
									break;
								case 'h':
									self._offset('h', parseInt(( self.dragStart - self.dragEnd ) / 32, 10));
									break;
								case 'i':
									self._offset('i', parseInt(( self.dragStart - self.dragEnd ) / 32, 10));
									break;
							}
						}
					} else if ( o.mode === 'flipbox' || o.mode === 'timeflipbox' ) {
						if ( self.dragEnd !== false ) {
							e.preventDefault();
							e.stopPropagation();
							var fld = self.dragTarget.parent().parent().jqmData('field'),
								amount = parseInt(( self.dragStart - self.dragEnd ) / 30,10);
							self._offset(fld, amount * ( (fld === "i") ? o.minuteStep : 1 ));
						}
					}
					self.dragStart = false;
					self.dragEnd = false;
				}
			});
		}
		
		// Disable when done if element attribute disabled is true.
		if ( self.input.is(':disabled') ) {
			self.disable();
		}
		// Turn input readonly if requested (on by default)
		if ( o.disableManualInput === true ) {
			self.input.attr("readonly", true);
		}
		
		//Throw dateboxinit event
		$( document ).trigger( "dateboxaftercreate" );
	},
	_makeElement: function(source, parts) {
		var self = this,
			part = false,
			retty = false;
		
		retty = source.clone();
		
		if ( typeof parts.attr !== 'undefined' ) {
			for ( part in parts.attr ) {
				if ( parts.attr.hasOwnProperty(part) ) {
					retty.jqmData(part, parts.attr[part]);
				}
			}
		}
		return retty;
	},
	_eventEnterValue: function (item) {
		var self = this,
			o = self.options,
			newHour = false;
		
		if ( item.val() !== '' && self._isInt(item.val()) ) {
			switch(item.jqmData('field')) {
				case 'm':
					self.theDate.setMonth(parseInt(item.val(),10)-1); break;
				case 'd':
					self.theDate.setDate(parseInt(item.val(),10)); break;
				case 'y':
					self.theDate.setFullYear(parseInt(item.val(),10)); break;
				case 'i':
					self.theDate.setMinutes(parseInt(item.val(),10)); break;
				case 'h':
					newHour = parseInt(item.val(),10);
					if ( newHour === 12 ) {
						if ( ( o.lang[o.useLang].timeFormat === 12 || o.timeFormatOverride === 12 ) && self.pickerMeri.val() === o.meridiemLetters[0] ) { newHour = 0; }
					}
					self.theDate.setHours(newHour);
					break;
			}
			self._update();
		}
	},
	_buildInternals: function () {
		// Build the POSSIBLY VARIABLE controls (these might change)
		var self = this,
			o = self.options, x, y, newHour, fld,
			linkdiv =$("<div><a href='#'></a></div>"),
			pickerContent = $("<div>", { "class": 'ui-datebox-container ui-overlay-shadow ui-corner-all ui-datebox-hidden pop ui-body-'+o.pickPageTheme} ).css('zIndex', o.zindex),
			templInput = $("<input type='"+o.internalInputType+"' />").addClass('ui-input-text ui-corner-all ui-shadow-inset ui-datebox-input ui-body-'+o.pickPageInputTheme),
			templInputT = $("<input type='text' />").addClass('ui-input-text ui-corner-all ui-shadow-inset ui-datebox-input ui-body-'+o.pickPageInputTheme),
			templControls = $("<div>", { "class":'ui-datebox-controls' }),
			templFlip = $("<div class='ui-overlay-shadow'><ul></ul></div>"),
			controlsPlus, controlsInput, controlsMinus, controlsSet, controlsHeader,
			pickerHour, pickerMins, pickerMeri, pickerMon, pickerDay, pickerYar, pickerSecs;
			
		self.calNoNext = false;
		self.calNoPrev = false;
		self.setButton = false;
		self.clearButton = false;
		self.dateOK = true;
		
		if ( o.fieldsOrderOverride === false ) {
			switch (o.mode) {
				case 'timebox':
				case 'timeflipbox':
					o.fieldsOrder = o.lang[o.useLang].timeFieldOrder; 
					break;
				case 'slidebox':
					o.fieldsOrder = o.lang[o.useLang].slideFieldOrder; 
					break;
				default:
					o.fieldsOrder = o.lang[o.useLang].dateFieldOrder; 
			}
		} else {
			o.fieldsOrder = o.fieldsOrderOverride;
		}
		
		/* Do the Date / Time Format */
		if ( o.timeOutputOverride !== false  ) {
			o.timeOutput = o.timeOutputOverride;
		} else if ( o.timeFormatOverride === false ) {
			o.timeOutput = o.timeFormats[o.lang[o.useLang].timeFormat];
		} else {
			o.timeOutput = o.timeFormats[o.timeFormatOverride];
		}
		
		if ( o.dateFormat !== false ) {
			o.dateOutput = o.dateFormat;
		} else {
			if ( typeof o.lang[o.useLang].dateFormat !== 'undefined' ) {
				o.dateOutput = o.lang[o.useLang].dateFormat;
			} else {
				o.dateOutput = o.defaultDateFormat;
			}
		}
		
		self.pickerContent.empty();
			
		/* BEGIN:DATETIME */
		if ( o.mode === 'datebox' || o.mode === 'timebox' ) {
			controlsHeader = $("<div class='ui-datebox-header'><h4>Unitialized</h4></div>").appendTo(self.pickerContent).find("h4");
			controlsPlus = templControls.clone().appendTo(self.pickerContent);
			controlsInput = templControls.clone().appendTo(self.pickerContent);
			controlsMinus = templControls.clone().appendTo(self.pickerContent);
			controlsSet = templControls.clone().appendTo(self.pickerContent);
			
			if ( o.mode === 'timebox' ) { controlsHeader.parent().empty(); } // Time mode has no header
			
			pickerMon = self._makeElement(templInput, {'attr': {'field':'m', 'amount':1} });
			pickerDay = self._makeElement(templInput, {'attr': {'field':'d', 'amount':1} });
			pickerYar = self._makeElement(templInput, {'attr': {'field':'y', 'amount':1} });
			pickerHour = self._makeElement(templInput, {'attr': {'field':'h', 'amount':1} });
			pickerMins = self._makeElement(templInput, {'attr': {'field':'i', 'amount':1} });
			pickerMeri = self._makeElement(templInputT, {'attr': {'field':'a', 'amount':o.minuteStep} });
				
			controlsInput.delegate('input', 'keyup', function() {
				self._eventEnterValue($(this));
			});
					
			if ( o.wheelExists ) { // Mousewheel operation, if plugin is loaded
				controlsInput.delegate('input', 'mousewheel', function(e,d) {
					e.preventDefault();
					self._offset($(this).jqmData('field'), ((d<0)?-1:1)*$(this).jqmData('amount'));
				});
			}
		
			for(x=0; x<=o.fieldsOrder.length; x++) { // Use fieldsOrder to decide what goes where
				if (o.fieldsOrder[x] === 'y') { pickerYar.appendTo(controlsInput); }
				if (o.fieldsOrder[x] === 'm') { pickerMon.appendTo(controlsInput); }
				if (o.fieldsOrder[x] === 'd') { pickerDay.appendTo(controlsInput); }
				if (o.fieldsOrder[x] === 'h') { pickerHour.appendTo(controlsInput); }
				if (o.fieldsOrder[x] === 'i') { pickerMins.appendTo(controlsInput); }
				if (o.fieldsOrder[x] === 'a' && ( o.lang[o.useLang].timeFormat === 12 || o.timeFormatOverride === 12 ) ) { pickerMeri.appendTo(controlsInput); }
			}
			
			if ( o.swipeEnabled ) { // Drag and drop support
				controlsInput.delegate('input', self.START_DRAG, function(e) {
					if ( !self.dragMove ) {
						self.dragMove = true;
						self.dragTarget = $(this).jqmData('field');
						self.dragPos = 0;
						self.dragStart = self.touch ? e.originalEvent.changedTouches[0].pageY : e.pageY;
						self.dragEnd = false;
						e.stopPropagation();
					}
				});
			}
			
			if ( o.noSetButton === false ) { // Set button at bottom
				self.setButton = $("<a href='#'>PlaceHolder</a>")
					.appendTo(controlsSet).buttonMarkup({theme: o.pickPageTheme, icon: 'check', iconpos: 'left', corners:true, shadow:true})
					.bind(o.clickEvent, function(e) {
						e.preventDefault();
						if ( self.dateOK === true ) {
							if ( o.mode === 'timebox' ) { self.input.trigger('datebox', {'method':'set', 'value':self._formatTime(self.theDate), 'date':self.theDate}); }
							else { self.input.trigger('datebox', {'method':'set', 'value':self._formatDate(self.theDate), 'date':self.theDate}); }
							self.input.trigger('datebox', {'method':'close'});
						}
					});
			}
			
			for( x=0; x<self.options.fieldsOrder.length; x++ ) { // Generate the plus and minus buttons, use fieldsOrder again
				if ( o.fieldsOrder[x] !== 'a' || o.lang[o.useLang].timeFormat === 12 || o.timeFormatOverride === 12 ) {
					for ( y=0; y<2; y++ ) {
						linkdiv.clone()
							.appendTo(((y===0)?controlsPlus:controlsMinus))
							.buttonMarkup({theme: o.pickPageButtonTheme, icon: ((y===0)?'plus':'minus'), iconpos: 'bottom', corners:true, shadow:true})
							.jqmData('field', o.fieldsOrder[x])
							.jqmData('amount', ((o.fieldsOrder[x]==='i')?o.minuteStep:1));
					}
				}
			}
			
			controlsPlus.delegate('div', o.clickEvent, function(e) {
				e.preventDefault();
				self._offset($(this).jqmData('field'), $(this).jqmData('amount'));
			});
			controlsMinus.delegate('div', o.clickEvent, function(e) {
				e.preventDefault();
				self._offset($(this).jqmData('field'), $(this).jqmData('amount')*-1);
			});
				
			$.extend(self, {
				controlsHeader: controlsHeader,
				pickerDay: pickerDay,
				pickerMon: pickerMon,
				pickerYar: pickerYar,
				pickerHour: pickerHour,
				pickerMins: pickerMins,
				pickerMeri: pickerMeri,
				controlsInput: controlsInput
			});
			
			self.pickerContent.appendTo(self.thisPage);
		}
		/* END:DATETIME */
		
		/* CLIP:DURATIONBOX */
		
		/* CLIP:SLIDEBOX */
		
		/* CLIP:FLIPBOX */
		
		/* CLIP:CALBOX */
		
		if ( o.useClearButton === true ) { // Clear button at very bottom
			self.clearButton = $("<a href='#'>PlaceHolder</a>")
				.appendTo(controlsSet).buttonMarkup({theme: o.pickPageTheme, icon: 'delete', iconpos: 'left', corners:true, shadow:true})
				.bind(o.clickEvent, function(e) {
					e.preventDefault();
					self.input.val('');
					self.input.trigger('datebox', {'method':'clear'});
					self.input.trigger('datebox', {'method':'close'});
				});
		}
		if ( o.collapseButtons && ( self.clearButton !== false && self.setButton !== false ) ) {
			controlsSet.addClass('ui-datebox-collapse');
		}
			
	},
	_buttonsTitle: function () {
		var self = this,
			o = this.options;
			
		// FIX THE DIALOG TITLE LABEL
		if ( o.titleDialogLabel === false ) {
			if ( typeof this.element.attr('title') !== 'undefined' ) {
				self.pickPageTitle.html(this.element.attr('title'));
			} else if ( this.focusedEl.parent().find('label').text() !== '' ) {
				self.pickPageTitle.html(this.focusedEl.parent().find('label').text());
			} else {
				switch (o.mode) {
					case "timebox":
					case "timeflipbox":
						self.pickPageTitle.html(o.lang[o.useLang].titleTimeDialogLabel);
						break;
					default:
						self.pickPageTitle.html(o.lang[o.useLang].titleDateDialogLabel);
						break;
				}
			}
		} else {
			self.pickPageTitle.html(o.titleDialogLabel);
		}
		
		// FIX THE CLEAR BUTTON
		if ( self.clearButton !== false ) {
			self.clearButton.find('.ui-btn-text').html(o.lang[o.useLang].clearButton);
		}
		
		// FIX THE SET BUTTON
		if ( self.setButton !== false ) {
			switch (o.mode) {
				case "timebox":
				case "timeflipbox":
					self.setButton.find('.ui-btn-text').html(o.lang[o.useLang].setTimeButtonLabel);
					break;
				case "durationbox":
					self.setButton.find('.ui-btn-text').html(o.lang[o.useLang].setDurationButtonLabel);
					break;
				case "calbox":
					self.setButton.find('.ui-btn-text').html(o.lang[o.useLang].calTodayButtonLabel);
					break;
				default:
					self.setButton.find('.ui-btn-text').html(o.lang[o.useLang].setDateButtonLabel);
					break;
			}
		}
	},
	_buildPage: function () {
		// Build the CONSTANT controls (these never change)
		var self = this,
			o = self.options, 
			pickerContent = $("<div>", { "class": 'ui-datebox-container ui-overlay-shadow ui-corner-all ui-datebox-hidden '+o.transition+' ui-body-'+o.pickPageTheme} ).css('zIndex', o.zindex),
			screen = $("<div>", {'class':'ui-datebox-screen ui-datebox-hidden'+((o.useModal)?' ui-datebox-screen-modal':'')})
				.css({'z-index': o.zindex-1})
				.appendTo(self.thisPage)
				.bind(o.clickEvent, function(event) {
					event.preventDefault();
					self.input.trigger('datebox', {'method':'close'});
				});
		
		if ( o.noAnimation ) { pickerContent.removeClass(o.transition); }
		
		$.extend(self, {
			pickerContent: pickerContent,
			screen: screen
		});
		
		self._buildInternals();
		
		// If useInline mode, drop it into the document, and stop a few events from working (or just hide the trigger)
		if ( o.useInline || o.useInlineBlind ) { 
			self.input.parent().parent().append(self.pickerContent);
			if ( o.useInlineHideInput ) { self.input.parent().hide(); }
			self.input.trigger('change');
			self.pickerContent.removeClass('ui-datebox-hidden');
		} else if ( o.centerWindow && o.useInlineHideInput ) {
			self.input.parent().hide();
		}
		if ( o.useInline ) {
			self.pickerContent.addClass('ui-datebox-inline');
			self.open();
		}
		if ( o.useInlineBlind ) {
			self.pickerContent.addClass('ui-datebox-inlineblind');
			self.pickerContent.hide();
		}
			
	},
	hardreset: function() {
		// Public shortcut to rebuild all internals
		this._buildInternals();
		this.refresh();
		this._buttonsTitle();
	},
	refresh: function() {
		// Pulic shortcut to _update, with an extra hook for inline mode.
		if ( this.options.useInline === true ) {
			this.input.trigger('change');
		}
		this._update();
	},
	open: function() {
		var self = this,
			o = this.options,
			coords = false, // Later, if need be
			transition = o.noAnimation ? 'none' : o.transition,
			callback, activePage;
			
		// Call the open callback if provided. Additionally, if this
		// returns falsy then the open of the dialog will be canceled
		if ( o.openCallback !== false ) {
			if ( ! $.isFunction(this.options.openCallback) ) {
				if ( typeof window[o.openCallback] !== 'undefined' ) {
					o.openCallback = window[o.openCallback];
				} else {
					o.openCallback = new Function(o.openCallback);
				}
			}
			callback = o.openCallback.apply(self, $.merge([self.theDate],o.openCallbackArgs));
			if ( callback == false ) { return false; }
		}
		
		
		self._buttonsTitle();
		
		// Open the controls
		if ( this.options.useInlineBlind ) { this.pickerContent.slideDown(); return false; } // Just slide if blinds mode
		if ( this.options.useInline ) { return true; } // Ignore if inline
		if ( this.pickPage.is(':visible') ) { return false; } // Ignore if already open
		
		this.theDate = this._makeDate(this.input.val());
		this._update();
		this.input.blur(); // Grab latest value of input, in case it changed
		
		// If the window is less than 400px wide, use the jQM dialog method unless otherwise forced
		if ( ( $(document).width() > 400 && !o.useDialogForceTrue ) || o.useDialogForceFalse || o.fullScreen ) {
			coords = this._getCoords(this); // Get the coords now, since we need em.
			o.useDialog = false;
			if ( o.nestedBox === true && o.fullScreen === false ) { 
				activePage = $('.ui-page-active').first(); 
				$(activePage).append(self.pickerContent);
				$(activePage).append(self.screen);
			}
			if ( o.fullScreenAlways === false || coords.width > 399 ) {
				if ( o.useModal === true ) { // If model, fade the background screen
					self.screen.fadeIn('slow');
				} else { // Else just unhide it since it's transparent (with a delay to prevent insta-close)
					setTimeout(function() {self.screen.removeClass('ui-datebox-hidden');}, 500);
				}
			}
			
			if ( o.fullScreenAlways === true || ( o.fullScreen === true && coords.width < 400 ) ) {
				self.pickerContent.addClass('in').css({'position': 'absolute', 'text-align': 'center', 'top': coords.fullTop-5, 'left': coords.fullLeft-5, 'height': coords.high, 'width': coords.width}).removeClass('ui-datebox-hidden');
			} else {
				self.pickerContent.addClass('ui-overlay-shadow in').css({'position': 'absolute', 'top': coords.winTop, 'left': coords.winLeft}).removeClass('ui-datebox-hidden');
				$(document).bind('orientationchange.datebox', {widget:self}, function(e) { self._orientChange(e); });
				if ( o.resizeListener === true ) {
					$(window).bind('resize.datebox', {widget:self}, function (e) { self._orientChange(e); });
				}
			}
		} else {
			// prevent the parent page from being removed from the DOM,
			self.thisPage.unbind( "pagehide.remove" );
			o.useDialog = true;
			self.pickPageContent.append(self.pickerContent);
			self.pickerContent.css({'top': 'auto', 'left': 'auto', 'marginLeft': 'auto', 'marginRight': 'auto'}).removeClass('ui-overlay-shadow ui-datebox-hidden');
			$.mobile.changePage(self.pickPage, {'transition': transition});
		}
	},
	close: function(fromCloseButton) {
		// Close the controls
		var self = this,
			o = this.options,
			callback;

		if ( o.useInlineBlind ) {
			self.pickerContent.slideUp();
			return false; // No More!
		}
		if ( o.useInline ) {
			return true;
		}
		
		// Check options to see if we are closing a dialog, or removing a popup
		if ( o.useDialog ) {
			if (!fromCloseButton) {
				$(self.pickPage).dialog('close');
			}
			if( !self.thisPage.jqmData("page").options.domCache ){
				self.thisPage.bind( "pagehide.remove", function() {
					$(self).remove();
				});
			}
			self.pickerContent.addClass('ui-datebox-hidden').removeAttr('style').css('zIndex', self.options.zindex);
			self.thisPage.append(self.pickerContent);
		} else {
			if ( o.useModal ) {
				self.screen.fadeOut('slow');
			} else {
				self.screen.addClass('ui-datebox-hidden');
			}
			self.pickerContent.addClass('ui-datebox-hidden').removeAttr('style').css('zIndex', self.options.zindex).removeClass('in');
		}
		self.focusedEl.removeClass('ui-focus');
		
		$(document).unbind('orientationchange.datebox');
		if ( o.resizeListener === true ) {
			$(window).unbind('resize.datebox');
		}
		
		
		if ( o.closeCallback !== false ) {
			if ( ! $.isFunction(o.closeCallback) ) {
				if ( typeof window[o.closeCallback] !== 'undefined' ) {
					o.closeCallback = window[o.closeCallback];
				} else {
					o.closeCallback = new Function(o.closeCallback);
				}
			}
			o.closeCallback.apply(self, $.merge([self.theDate], o.closeCallbackArgs));
			
		}
	},
	disable: function(){
		// Disable the element
		this.element.attr("disabled",true);
		this.element.parent().addClass("ui-disabled");
		this.options.disabled = true;
		this.element.blur();
		this.input.trigger('datebox', {'method':'disable'});
	},
	enable: function(){
		// Enable the element
		this.element.attr("disabled", false);
		this.element.parent().removeClass("ui-disabled");
		this.options.disabled = false;
		this.input.trigger('datebox', {'method':'enable'});
	},
	_setOption: function( key, value ) {
		var noReset = ['minYear','maxYear','afterToday','beforeToday','maxDays','minDays','highDays','highDates','blackDays','blackDates','enableDates'];
		$.Widget.prototype._setOption.apply( this, arguments );
		if ( $.inArray(key, noReset) > -1 ) {
			this.refresh();
		} else {
			this.hardreset();
		}
	}
	
  });
	  
  // Degrade date inputs to text inputs, suppress standard UI functions.
  $( document ).bind( "pagebeforecreate", function( e ) {
	$( ":jqmData(role='datebox')", e.target ).each(function() {
		$(this).prop('type', 'text');
	});
  });
  // Automatically bind to data-role='datebox' items.
  $( document ).bind( "pagecreate create", function( e ){
	$( document ).trigger( "dateboxbeforecreate" );
	$( ":jqmData(role='datebox')", e.target ).each(function() {
		if ( typeof($(this).data('datebox')) === "undefined" ) {
			$(this).datebox();
		}
	});
  });
	
})( jQuery );
