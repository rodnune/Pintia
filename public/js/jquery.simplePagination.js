(function($) {
	$.fn.simplePagination = function(options) {
		
		var defaults = {
			perPage: 5,
			containerClass: '',
			previousButtonClass: '',
			
			nextButtonClass: '',
			previousButtonText: '<',
			nextButtonText: '>',
			
			previousButtonClass2: '',
			nextButtonClass2: '',
			previousButtonText2: '<<',
			nextButtonText2: '>>',
			
			previousButtonClass3: '',
			nextButtonClass3: '',
			previousButtonText3: 'Primera',
			nextButtonText3: 'Última',
			
			currentPage: 1
		};

		var settings = $.extend({}, defaults, options);

		return this.each(function() {
			var $rows = $('tbody tr', this);
			var pages = Math.ceil($rows.length/settings.perPage);
			var container = document.createElement('div');
			
			var bPrevious = document.createElement('button');
			var bNext = document.createElement('button');
			
			var bPrevious2 = document.createElement('button');
			var bNext2 = document.createElement('button');
			
			var bPrevious3 = document.createElement('button');
			var bNext3 = document.createElement('button');
			
			var of = document.createElement('span');

			bPrevious.innerHTML = settings.previousButtonText;
			bNext.innerHTML = settings.nextButtonText;
			
			bPrevious2.innerHTML = settings.previousButtonText2;
			bNext2.innerHTML = settings.nextButtonText2;

			bPrevious3.innerHTML = settings.previousButtonText3;
			bNext3.innerHTML = settings.nextButtonText3;
			
			container.className = settings.containerClass;
			bPrevious.className = settings.previousButtonClass;
			bNext.className = settings.nextButtonClass;
			
			bPrevious2.className = settings.previousButtonClass2;
			bNext2.className = settings.nextButtonClass2;
			
			bPrevious3.className = settings.previousButtonClass3;
			bNext3.className = settings.nextButtonClass3;

			bPrevious.style.marginRight = '8px';
			bNext.style.marginLeft = '8px';
			
			bPrevious2.style.marginRight = '-5px';
			bNext2.style.marginLeft = '-5px';
			
			bPrevious3.style.marginRight = '-5px';
			bNext3.style.marginLeft = '-5px';
			
			container.style.textAlign = "center";
			container.style.marginBottom = '20px';

			container.appendChild(bPrevious3);
			container.appendChild(bPrevious2);
			container.appendChild(bPrevious);
			container.appendChild(of);
			container.appendChild(bNext);
			container.appendChild(bNext2);
			container.appendChild(bNext3);

			$(this).after(container);

			update();

			$(bNext).click(function() {
				if (settings.currentPage + 1 > pages) {
					settings.currentPage = pages;
				} else {
					settings.currentPage++;
				}

				update();
			});
			
			
			$(bNext2).click(function() {
				if (settings.currentPage + 5 > pages) {
					settings.currentPage = pages;
				} else {
					settings.currentPage += 5;
				}

				update();
			});
			
			$(bNext3).click(function() {
				
				settings.currentPage = pages;

				update();
			});
			
			$(bPrevious3).click(function() {
				
				settings.currentPage = 1;

				update();
			});
			
			$(bPrevious2).click(function() {
				if (settings.currentPage - 5 < 1) {
					settings.currentPage = 1;
				} else {
					settings.currentPage -= 5;
				}

				update();
			});

			$(bPrevious).click(function() {
				if (settings.currentPage - 1 < 1) {
					settings.currentPage = 1;
				} else {
					settings.currentPage--;
				}

				update();
			});

			function update() {
				var from = ((settings.currentPage - 1) * settings.perPage) + 1;
				var to = from + settings.perPage - 1;

				if (to > $rows.length) {
					to = $rows.length;
				}

				$rows.hide();
				$rows.slice((from-1), to).show("slow");

				of.innerHTML = from + ' - ' + to + ' de ' + $rows.length + ' resultados';

				if ($rows.length <= settings.perPage) {
					$(container).hide();
				} else {
					$(container).show();
				}
			}
		});

	}

}(jQuery));