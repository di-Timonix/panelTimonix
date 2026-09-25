	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Skrypty do zarządzania
	
	*/
	
	$(document).on("click", ".arads-serwer-change-data", function () {
		let t = $(this).closest(".arads-serwer");
		t.find(".arads-serwer-data").toggleClass("tsr-display-none");
	})
	
	$(document).on("dblclick", ".arads-serwer-change-data-p", function () {
		//let t = $(this).closest(".arads-serwer");
		//t.find(".arads-serwer-data").toggleClass("tsr-display-none");
		
		// console.log($(this));
		// console.log($(this).closest(".arads-serwer").find(".arads-serwer-data"));
		// console.log($(this).closest(".arads-serwer").find(".arads-serwer-data").eq(0).hasClass("tsr-display-none"));
		
		//let eq = $(this).closest(".arads-serwer").find(".arads-serwer-data").eq(0).hasClass("tsr-display-none");
		
		let t = $(document).find(".arads-serwer-change-data").closest(".arads-serwer");
		t.find(".arads-serwer-data").toggleClass("tsr-display-none");
		
		// if (eq == false) {
			// for (let i = 0; i < 5; i++) {
				// t.addClass("tsr-display-none");
			// }
			// for (let i = 4; i < 9; i++) {
				// t.removeClass("tsr-display-none");
			// }
		// }else{
			// for (let i = 0; i < 5; i++) {
				// t.removeClass("tsr-display-none");
			// }
			// for (let i = 4; i < 9; i++) {
				// t.addClass("tsr-display-none");
			// }
		// }
	})