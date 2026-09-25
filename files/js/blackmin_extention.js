/*
//
//				Black min cms - reguły javascript\jquery
//									V.1.0
//				  Wszelkie Prawa Zaszczeżone by Timonix
//
*/

	// Filtrowanie i dodawnie do strony kodu napisanego przez autora posta ON //

	$(document).ready(function(){

		// dodawanie klasy do kontentu posta
		var a =  $(this).find(".blackmin-wlasny-kod");
		//////////////var wkod =  a.text();
		//$(".blackmin-wlasny-kod").html = wkod;
		///////a.append(wkod );
		//console.log(wkod);
	
		if(a.length) {
			/////console.log(a.length);
			var wkod =  a.text();
			//console.log(a.index( wkod ));
			/////console.log(a);
			//a[1].append(wkod );
			//$(".blackmin-wlasny-kod").html = wkod;
			//a.remove();
			//a.text("");
			//a.append(wkod );
			for(var i=0;i<a.length; i++){
				var wkod2 =  $(a[i]).text();
				$(a[i]).text("");
				$(a[i]).append(wkod2);
				//console.log($(a[i]).text());
			}
		}
	
	});
	
	// Filtrowanie i dodawnie do strony kodu napisanego przez autora posta OFF //	