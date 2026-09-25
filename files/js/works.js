	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Skrypty do zarządzania wszystkimi pracami do aplikacji
	
	*/
	
	$(document).on("change", '[name="arads-select-projekt"]', (event) => {
		arads_load_work_data ();
		$(".arads-work-loads").prepend('<section class="tsr-alert tsr-alert-info">Ładowanie Danych!</section>');
	});
	
	$(document).on("change", '[name="arads-select-status"]', (event) => {
		arads_load_work_data ();
		$(".arads-work-loads").prepend('<section class="tsr-alert tsr-alert-info">Ładowanie Danych!</section>');
	});
	
	$(document).on("change", '[name="arads-select-priorytet"]', (event) => {
		arads_load_work_data ();
		$(".arads-work-loads").prepend('<section class="tsr-alert tsr-alert-info">Ładowanie Danych!</section>');
	});
	
	$(document).on("keypress", '[name="arads-select-tytul"]', (event) => {
		arads_load_work_data ();
		$(".arads-work-loads").prepend('<section class="tsr-alert tsr-alert-info">Ładowanie Danych!</section>');
	});
	
	function arads_load_work_data () {
		var a = $(document).find('[name="arads-select-projekt"]').val(),
				b = $(document).find('[name="arads-select-status"]').val(),
				c = $(document).find('[name="arads-select-priorytet"]').val(),
				d = $(document).find('[name="arads-select-tytul"]').val();
		tsr_ajax("kontent/sub-kontent/work-all.php", {
			"akcja": "load_page",
			"strona_laduj": "works",
			"arads_select_projekt": a,
			"arads_select_status": b,
			"arads_select_priorytet": c,
			"arads_select_tytul": d
		}, '', false, function (t) {
			$(".arads-work-loads").html(t);
			$(".arads-work-loads").find(".arads-work-loads").removeClass("arads-work-loads");
		}, function (e) {
			$(".arads-work-loads").html('<section class="tsr-alert tsr-alert-error">Wystąpił Błąd pod czas ładowania strony!</section>');
		});
	}
	
	$(document).on("click", ".arads-async-load-page", function () {
		$(".arads-work-loads").prepend('<section class="tsr-alert tsr-alert-info">Ładowanie Danych!</section>');
		tsr_ajax("ajax.php", {
			"akcja": "load_page",
			"strona_laduj": "works",
		}, $(this).attr("href"), false, function (t) {
			$(".tsr-page-active").html(t);
		}, function (e) {
			$(".arads-work-loads").html('<section class="tsr-alert tsr-alert-error">Wystąpił Błąd pod czas ładowania strony!</section>');
		});
	})