/*
@
@		>>>> AQUAY <<<<
@
@	Timonix Aquay Edytor
@	Edytor Tekstowy
@	Versja: beta 0.1
@	Autor: Timonix
@   Cobright: Wszelkie prawa zasczeżone 
@
@		>>>> AQUAY <<<<
@
*/

	// tworzenie
	var aquay = "aquay";
	
	// tworzenie logów do konsoli przeglądarki
	console.info("Iniciowanie: " + aquay);
	console.info("Startowanie: " + aquay);
	console.info("Ładowanie: " + aquay);
	
	var aquay_text = $(".aquay-text");
	

	var showingSourceCode = false;
	var isInEditMode = true;
	var aquay_edytuj_frame = $(".aquay-text");
	
	var aquay_add_klucz = 0;

	//var selectedText = window.getSelection();
    //var range = selectedText.getRangeAt(0);
    //var boundary = range.getBoundingClientRect();
	
	//var selectedText = getSelText();
   // var range = document.selection.getRangeAt(0);
    //var boundary = range.getBoundingClientRect();
	
	
	//////////////////////////var sel = window.getSelection && window.getSelection();
	//reselecting:
	//window.getSelection().addRange(sel);
	//////////////if (sel) {
	//////////////  var range = sel.getRangeAt(0); // error here
	/////////////  var node = document.createTextNode("console");
	  //range.deleteContents();
	 // range.insertNode(node);
	////////////////////////////////// console.log(node);
	
	var showTextOptions = function() {
      var selectedText = window.getSelection();
      var range = selectedText.getRangeAt(0);
      var boundary = range.getBoundingClientRect();

		console.log(selectedText);
		console.log(range);

    };
	
	var getSelectionStart = function() {
      var node = document.getSelection().anchorNode,
          startNode = (node && node.nodeType === 3 ? node.parentNode : node);
      return startNode;
    }
	
	console.log(getSelectionStart());;
	console.log(showTextOptions);
	

	function getSelText(){
	    var txt = '';
	     if (window.getSelection)
	    {
	        txt = window.getSelection();
	    }
	    else if (document.getSelection)
	    {
	        txt = document.getSelection();
	            }
	    else if (document.selection)
	    {
	        txt = document.selection.createRange().text;
	            }
	    else return;
		$("#kks").val(txt);
	//console.log(txt);
	//document.aform.selectedtext.value = txt;
	}
	
	// funkcjia do wstawiania tekstu w wskazania kursora
	/*function doInsert(text) {
        var sel = window.getSelection && window.getSelection();
        if (sel) {
            var range = sel.getRangeAt(0);              // error here
            var node = document.createTextNode(text);
            range.deleteContents();
            range.insertNode(node);
        }
    }*/
	
	// funkcje edytora tekstu aquay
	function aquay_edytor (command) {
		document.execCommand(command, false , null);
	}
	
	function aquay_edytor_format (command, arg) {
		document.execCommand(command, false, arg);
	}

	function aquay_edytor_link (command) {
		 //link:
		//document.execCommand(command, false, arg);
		//$('a[href="LINK_TO_CHANGE"').attr('target', '_blank');
		//any other attr changes here
		//$('a[href="LINK_TO_CHANGE"').attr('href', theRealHref);
		
		var theSelection = window.getSelection();
		var theRange = theSelection.getRangeAt(0);
		
		//theSelection = theIframe.contentWindow.getSelection();
		//theRange = theSelection.getRangeAt(0);

		
		
		console.log(theSelection);
		console.log(theRange);
		
		var url_add= $('input[name="url_add"]').val();
		var tytul_add= $('input[name="tytul_add"]').val();
		var target_add= $('select[name="target_add"]').val();
		
		url = url_add + "\\" + tytul_add + "\\" + 'target="' + target_add + '"';


		$('a[href="LINK_TO_EDIT"').attr('target', target_add);
		$('a[href="LINK_TO_EDIT"').attr('title', tytul_add);
		$('a[href="LINK_TO_EDIT"').attr('href', url_add);
		
		var ostatni_url = url_add;
		
		$('a[href="' + ostatni_url + '"').attr('target', target_add);
		$('a[href="' + ostatni_url + '"').attr('title', tytul_add);
		$('a[href="' + ostatni_url + '"').attr('href', url_add);
		
		/*theRange.extractContents(false);
		var newLink = document.createElement("a");
		var someText = document.createTextNode(theSelection);
		newLink.target = target_add;
		newLink.href = url_add;
		newLink.title = tytul_add;
		newLink.appendChild(someText);
		theRange.insertNode(newLink);*/
		
		console.log(url);
		
		//document.execCommand(command, false, url);
	}
	
	function aquay_edytor_add_link (command) {
		var theSelection = window.getSelection();
		var theRange = theSelection.getRangeAt(0);
		console.log(theSelection);
		console.log(theRange);
		document.execCommand(command, false, 'LINK_TO_EDIT');
	}

	function doInsert() {
        var sel = window.getSelection && window.getSelection();
        if (sel) {
            var range = sel.getRangeAt(0);              // error here
            var node = document.createTextNode(text);
           // range.deleteContents();
            //range.insertNode(node);
			console.log(node);
        }
    }

	function aquay_edytor_toggle_kod () {
		if(showingSourceCode){
			//$(".aquay-text").html = $(".aquay-text").text();
			var aquay_tresc = $(".aquay-text").text();
			$(".aquay-text").html(aquay_tresc);
			//console.log(aquay_tresc);
			showingSourceCode = false;
		}else{
			//$(".aquay-text").text = $(".aquay-text").html();
			var aquay_kod = $(".aquay-text").html();
			$(".aquay-text").text(aquay_kod);
			//console.log(aquay_kod);
			showingSourceCode = true;
		}
	}

	function aquay_edytor_toggle_edytuj () {
		if(isInEditMode){
			$(".aquay-text").designMode = 'Off';
			isInEditMode = false;
			$(".aquay-edytuj-text").attr("contenteditable", "false");
		}else{
			$(".aquay-text").designMode = 'On';
			$(".aquay-edytuj-text").attr("contenteditable", "true");
			isInEditMode = true;
		}
	}	

	function aquay_edytor_get_code () {
		var aquay_get_kod = $(".aquay-text").html();
		console.info("Pobieranie kodu: " + aquay);
		console.info("Kod został pobrany prawidłowo: " + aquay);
		return aquay_get_kod;
	}	

	// pobranie danych do dodania linku
	
	$('#link_add').on('click', function(oEvent){	
		var url_add= $('input[name="url_add"]').val();
		var tytul_add= $('input[name="tytul_add"]').val();
		var target_add= $('select[name="target_add"]').val();
		
		url = url_add + "\\" + tytul_add + "\\" + 'target="' + target_add + '"';
		
		aquay_edytor_link('createLink', url);
		
		console.log(url);
		
	});	
	
	// pokazywanie menu wyboru wstawiania nowych elementów po pliknięciu
	
	$(document).on("click", ".aquay-edytor-menu", function(oEvent){
		$(".aquay-edytor-element-menu").toggleClass("aquay-edytor-menu-visable");
		 return false;
	});	
	
	$(document).click(function (event) {
		if ($(event.target).closest(".aquay-edytor-element-menu").length === 0) {
			$(".aquay-edytor-element-menu").removeClass("aquay-edytor-menu-visable");
		}
	});
	
	// po wpisaniu 1 znaku przycisk do dodawania z dysku zostanie schowany
	// jeżeli będzie miał wartosc null to pokażemy przycisk z powrotem
	$(document).on("keyup", ".aquay-link", function(oEvent){
		var aquay_keypress = $(this).closest(".aquay-link").val().length;
		
		if (aquay_keypress >= 1) {
			$(this).closest(".aquay-edytuj-container").find(".aquay-add-media").addClass("aquay-hidden");
			var url_get_img = $(this).closest(".aquay-edytuj-container").find(".aquay-link").val();
			
			// tworzenie elementu img jeżeli zostanie podana wartosc
			var add_img_obrazek = document.createElement("img");
			add_img_obrazek.setAttribute('src', url_get_img);
			add_img_obrazek.setAttribute('alt', url_get_img);
			add_img_obrazek.setAttribute('title', url_get_img);
			add_img_obrazek.setAttribute('class', "aquay-obrazek");
			
			$(this).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").find(".aquay-obrazek").remove();
			$(this).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").append(add_img_obrazek);
		}else{
			$(this).closest(".aquay-edytuj-container").find(".aquay-add-media").removeClass("aquay-hidden");
			$(this).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").find(".aquay-obrazek").remove();
		}
		
	});	
	
	// usuwanie elementów po podwójnym kliknięciu na nazwę bloku
	$(document).on("dblclick", ".aquay-type-title", function(oEvent){
		console.log("sdsd");
		$(this).closest(".aquay-type-title").closest(".aquay-edytuj-container").remove();
	});	

	// sortowanie kontenerów bloków
	// przeciąganie w górę i w dół
	$( function() {
		$( ".aquay-text" ).sortable({
		  connectWith: ".aquay-text",
		  handle: ".aquay-type-title",
		  cancel: ".aquay-toggle",
		  placeholder: "aquay-placeholder"
		});
	 
		$( ".aquay-edytuj-container" )
		//.prepend( "<span class='ui-icon ui-icon-minusthick aquay-toggle'></span>")
		  //.addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
		  .find( ".aquay-type-title" )
			//.addClass( "ui-widget-header ui-corner-all" )
			//.prepend( "<span class='ui-icon ui-icon-minusthick aquay-toggle'></span>");
			;
	 
		$( ".aquay-toggle" ).on( "click", function() {
		  var icon = $( this );
		  //icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
		  icon.closest( ".aquay-edytuj-container" ).find( ".aquay-edytuj-text" ).toggle();
		});
	});

	// modal ------- modal ---- aquay ---- modal -------- modal //

	// tworzenie modal boxa
	$(document).on("click", ".aquay-open-modal", function(oEvent){
		var aquay_open_modal = $(this).closest(".aquay-open-modal").attr('id');
		var aquay_this_button = $(this).closest(".aquay-open-modal").attr('id');
		var aquay_this_multiply = $(this).closest(".aquay-open-modal").attr('data-multiply');
		var aquay_this_typebox = $(this).closest(".aquay-edytuj-container").attr('data-blok-type');
		var aquay_this_element = ".aquay-modal-" + aquay_open_modal;

		// dodawanie do html klasy > blokada przesuwania (scrola)
		$("html").addClass("aquay-modal-html");
		
		// blokowanie dodawania własnego obrazka po przez url
		//////$(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").addClass("aquay-hidden");
		var this_obrzek_url = $(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url");

		// sprawdzanie czy dany modal box jstnieie. jeżeli tak to go pokażemy jeżeli nie to tworzymy go na nowo i wyświetlamy
		if($(aquay_this_element).length==1) {
			$(aquay_this_element).removeClass("aquay-hidden");
		} else {
			// tworzenie elementu modal by wyświetlić zawartość
			var add_modal_div = document.createElement("div");
			add_modal_div.setAttribute('title', "aquay / black min / modal");
			add_modal_div.setAttribute('class', "aquay-modals" + " aquay-modal-" + aquay_open_modal);
			add_modal_div.setAttribute('id', "aquay-modal-" + aquay_open_modal);
			
			// dodawanie stworzonego elementu do dokumentu html 
			$(this).closest("body").append(add_modal_div);
			
			// tworzenie elementu modal container by wyświetlić dopasowaną zawartość
			var add_modal_div_container = document.createElement("div");
			add_modal_div_container.setAttribute('title', "aquay / black min / modal");
			add_modal_div_container.setAttribute('class', "aquay-modal-container");
			
			// dodawanie stworzonego elementu do dokumentu html 
			$(aquay_this_element).append(add_modal_div_container);
			
			// tworzenie elementu modal container by wyświetlić dopasowaną zawartość
			var add_modal_div_container_load = document.createElement("div");
			add_modal_div_container_load.setAttribute('title', "aquay / black min / modal load");
			add_modal_div_container_load.setAttribute('class', "aquay-modal-load");
			
			// dodawanie stworzonego elementu do dokumentu html 
			$(aquay_this_element).find(".aquay-modal-container").append(add_modal_div_container_load);

			// tworzenie elementu modal container by wyświetlić dopasowaną zawartość
			var add_modal_closed = document.createElement("div");
			add_modal_closed.setAttribute('title', "aquay / black min / modal closed");
			add_modal_closed.setAttribute('class', "aquay-modal-closed");
			
			// dodawanie stworzonego elementu do dokumentu html 
			$(aquay_this_element).find(".aquay-modal-container").append(add_modal_closed);
			
			load_dysk_media("25", aquay_this_multiply, aquay_this_element, aquay_this_typebox, aquay_this_button, aquay_open_modal);			
		}
		
		return false;
	});	

	// przypisywanie modalowi funkcji bez kliknięcia
	$(document).on("click", ".jquery-modal", function(oEvent){
		return false;
	});	
	
	// zamykanie modal boxa po kliknięciu na czarne pole
	$(document).click(function (event) {
		if ($(event.target).closest(".aquay-modal-container").length === 0) {
			$(".aquay-modals").addClass("aquay-hidden");
			
			// usuwanie z html klasy > blokada przesuwania (scrola)
			$("html").removeClass("aquay-modal-html");
			// odblokowanie dodawania własnego obrazka po przez url
			$(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").removeClass("aquay-hidden");
		}
	});
	
	// zamykanie modal boxa po kliknięciu na zakmkcji modal box
	$(document).on("click", ".aquay-modal-closed", function(oEvent){
		$(".aquay-modals").addClass("aquay-hidden");
			
		// usuwanie z html klasy > blokada przesuwania (scrola)
		$("html").removeClass("aquay-modal-html");
		// odblokowanie dodawania własnego obrazka po przez url
		$(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").removeClass("aquay-hidden");
		$(this).closest(aquay_open_modal).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").removeClass("aquay-hidden");
		$(this_obrzek_url).removeClass("aquay-hidden");
	});	

	// zamykanie modal boxa po kliknięciu na zakmkcji modal box
	function aquay_cloase_modal(){
		$(".aquay-modals").addClass("aquay-hidden");
		
		// usuwanie z html klasy > blokada przesuwania (scrola)
		$("html").removeClass("aquay-modal-html");
		// odblokowanie dodawania własnego obrazka po przez url
		$(this).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").removeClass("aquay-hidden");
	};	
	
	// ładowanie pliku który doda nam zdjęcie z dysku (db)

	function load_dysk_media(ile_load, multiply, get_plik, typebox, button, klucz) {
		console.log(button);
		$.ajax({
			type:"POST",
			//url:"laduj/all-dysk-get-media.php",
			url:"admin-dysk-get-media.php",
			data:{
				ile_load:ile_load,
				multiply:multiply,
				get_plik:get_plik,
				typebox:typebox,
				button:button,
				klucz:klucz,
			}
		})
		.done(function(info){
			//$('#contajner_post_add').text("");
			$(get_plik).find(".aquay-modal-container").find(".aquay-modal-load").append(info);
			$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
		})
		.fail(function(){
			alert("Wystąpił błąd. Spróbuj ponownie później");
		});
		
	}	
	
	// modal ------- modal ---- aquay ---- modal -------- modal //

	// funkcjia do pobierania pliku i wstawianie go do boxa img 
	function add_media_to_element(akcja_records, typebox, button, src________) {
		var this_button_add = "#" + button;
		var src = "";
		console.log(typebox);console.log(this_button_add);
		
		// howanie dodawania włanego niestandardowego zdjecja
		$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-obrazek-url").addClass("aquay-hidden");
		
		// sprawdzenie czy element dodający to zdjęcie
		if (typebox == "type_blok/black_min_miniaturka_post"){

			// pobieranie src wybranego img
			src = $('.id-records-'+ akcja_records).find(".img").attr("src");
			alt = $('.id-records-'+ akcja_records).find(".img").attr("title");
			
			// tworzenie elementu img jeżeli zostanie podana wartosc
			var add_img_obrazek = document.createElement("img");
			add_img_obrazek.setAttribute('src', src);
			add_img_obrazek.setAttribute('alt', alt);
			add_img_obrazek.setAttribute('title', alt);
			add_img_obrazek.setAttribute('class', "black-min-miniaturka-post");
			
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").find(".black-min-miniaturka-post").remove();
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").append(add_img_obrazek);
			
		}

		// sprawdzenie czy element dodający to zdjęcie
		if (typebox == "type_blok/obrazek"){

			// pobieranie src wybranego img
			src = $('.id-records-'+ akcja_records).find(".img").attr("src");
			alt = $('.id-records-'+ akcja_records).find(".img").attr("title");
			data_obrazek = $('.id-records-'+ akcja_records).find(".img").attr("data-grafika");
			
			// tworzenie elementu img jeżeli zostanie podana wartosc
			var add_img_obrazek = document.createElement("img");
			add_img_obrazek.setAttribute('src', src);
			add_img_obrazek.setAttribute('alt', alt);
			add_img_obrazek.setAttribute('title', alt);
			add_img_obrazek.setAttribute('class', "aquay-obrazek");
			add_img_obrazek.setAttribute('data-grafika', data_obrazek);
			
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").find(".aquay-obrazek").remove();
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-obrazek").append(add_img_obrazek);
			
		}
		
		if (typebox == "type_blok/galeria"){
			
			// usuwanie poprzedniego img aby zastąpić nowym
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-galeria").find(".aquay-galeria").remove();
			
			for (var i=0; i< akcja_records.length; i++){

				// pobieranie src wybranego img
				src = $('.id-records-'+ akcja_records[i]).find(".img").attr("src");
				alt = $('.id-records-'+ akcja_records).find(".img").attr("title");
				data_obrazek = $('.id-records-'+ akcja_records).find(".img").attr("data-grafika");
				
				// tworzenie elementu img jeżeli zostanie podana wartosc
				var add_img_obrazek = document.createElement("img");
				add_img_obrazek.setAttribute('src', src);
				add_img_obrazek.setAttribute('alt', alt);
				add_img_obrazek.setAttribute('title', alt);
				add_img_obrazek.setAttribute('class', "aquay-galeria");
				add_img_obrazek.setAttribute('data-grafika', data_obrazek);
				
				$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-galeria").append(add_img_obrazek);

			}
			
		}

		if (typebox == "type_blok/plik"){
			
			// usuwanie poprzedniego img aby zastąpić nowym
			$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-galeria").find(".aquay-galeria").remove();
			
			for (var i=0; i< akcja_records.length; i++){

				// pobieranie src wybranego img
				src = $('.id-records-'+ akcja_records[i]).find(".img").attr("data-sciezka")
				
				$(this_button_add).closest(".aquay-edytuj-container").find(".aquay-load-plik").attr("data-pobierz", src);

			}
			
		}
	
		aquay_cloase_modal();
	};

	// funkcjie do wstawiania elementów do edytora aquay
	//$(".aquay-blok-akapit").on('click', ".aquay-blok-akapit", function(oEvent){	
	//	$(".aquay-kopia-blok-text").clone().remove('div[class=".aquay-kopia-blok-text"]').appendTo(".aquay-text");
	//	console.log("s");
	//});	
	
	//$(".aquay-blok-akapit").click(function(oEvent){	
	//	$(".aquay-kopia-blok-text").clone().remove('div[class=".aquay-kopia-blok-text"]').appendTo(".aquay-text");
	//	console.log("s");
	//});	
	
	$(document).ready(function() { 
		$(".aquay-blok-akapit").on( "click", function() {
			$(".aquay-kopia-blok-text > div").clone().appendTo(".aquay-text");
		});
	});
		
	$(document).on('click', ".aquay-blok-cytat", function(oEvent){	
		//$(".aquay-text").appendTo('<div class="edytor-img" data-type="type/img">wstaw link</div>');
		$(".aquay-kopia-blok-cytat > div").clone().remove('div[class=".aquay-kopia-blok-text"]').appendTo(".aquay-text");
	});	

	$(document).on('click', ".aquay-blok-naglowek", function(oEvent){	
		//$(".aquay-text").appendTo('<div class="edytor-img" data-type="type/img">wstaw link</div>');
		$(".aquay-kopia-blok-naglowek > div").clone().appendTo(".aquay-text");
	});	
	
	$(document).on('click', ".aquay-blok-kod", function(oEvent){	
		//$(".aquay-text").appendTo('<div class="edytor-img" data-type="type/img">wstaw link</div>');
		$(".aquay-kopia-blok-kod > div").clone().appendTo(".aquay-text");
	});	

	$(document).on('click', ".aquay-blok-wlasny-html", function(oEvent){	
		//$(".aquay-text").appendTo('<div class="edytor-img" data-type="type/img">wstaw link</div>');
		$(".aquay-kopia-blok-wlasny-html > div").clone().appendTo(".aquay-text");
	});	
	
	$(document).on('click', ".aquay-blok-obrazek", function(oEvent){	
		//$(".aquay-text").appendTo('<div class="edytor-img" data-type="type/img">wstaw link</div>');
		$(".aquay-kopia-blok-obrazek > div").clone().appendTo(".aquay-text").closest(".aquay-edytuj-container").find(".aquay-add-media").attr("id", "aquay_" + aquay_add_klucz);
		aquay_add_klucz++;
	});	
	
	$(document).on('click', ".aquay-blok-galeria", function(oEvent){	
		$(".aquay-kopia-blok-galeria > div").clone().appendTo(".aquay-text").closest(".aquay-edytuj-container").find(".aquay-add-media").attr("id", "aquay_" + aquay_add_klucz);
		aquay_add_klucz++;
	});	
	
	$(document).on('click', ".aquay-blok-plik", function(oEvent){	
		//$(".aquay-text").appendTo('<div class="edytor-img" data-type="type/img">wstaw link</div>');
		$(".aquay-kopia-blok-plik > div").clone().appendTo(".aquay-text").closest(".aquay-edytuj-container").find(".aquay-add-media").attr("id", "aquay_" + aquay_add_klucz);
		aquay_add_klucz++;
	});	
	
	// powiadomienie o zakończeniu ładowania
	
	$(document).ready(function() { 
		console.info("Ładowanie Zakończone: " + aquay);
	});