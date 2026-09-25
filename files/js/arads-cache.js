	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		Skrypt zarządza cache panelu arads
	
	*/
	
	async function arads_cache(load = {arads_cache: {load: "all"}}, time = (2*24), callback = null, s = false, exe = "add", inte = null) {
		if (storageAvailable('localStorage')) {
			let st = localStorage;
			const d = new Date();
			
			if (exe === "add") {
				if (!st.getItem(load["arads_cache"]["load"])) {
					set ();
				}else{
					get ();
				}
			}else if (exe === "update") {
				set ();
				
				if (inte != null) {
					window.setTimeout(function () {
						arads_cache(load, time, callback, s, exe, inte);
					}, inte);
				}else{
					return true;
				}
			}else if (exe === "unset") {
				st.removeItem(load["arads_cache"]["load"]);
				st.removeItem(load["arads_cache"]["load"] + '_time');
				
				if (callback != null) {
					return callback(rt);
				}else{
					return true;
				}
			}else{
				console.warm("Nie znaleziono polecenia cache!");	
				return false;
			}
			
			function set () {
				let cache = tsr_ajax ("arads-cache.php", load, "", false, function (t) {
					
					if(is_json(t)){
						// konwertowanie json to string
						rt = JSON.parse(t);
						
						if (rt["type"] == "cache/404") {
							if (s === false) {
								console.error(rt["message"]);
								let a = $(document).find(".container").before('<section class="tsr-alert tsr-alert-error tsr-p10px"> Cache / '+ rt["message"] +' </section>');
								$(a[0].previousSibling).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
							}
						}else if (rt["type"] == "cache/access_deney") {
							if (s === false) {
								console.warn(rt["message"]);
								let a = $(document).find(".container").before('<section class="tsr-alert tsr-alert-warning tsr-p10px"> Cache / '+ rt["message"] +' </section>');
								$(a[0].previousSibling).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
							}
						}else if (rt["type"] == "cache/method") {
							if (s === false) {
								console.warn(rt["message"]);
								let a = $(document).find(".container").before('<section class="tsr-alert tsr-alert-warning tsr-p10px"> Cache / '+ rt["message"] +' </section>');
								$(a[0].previousSibling).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
							}
						}else{
							st.setItem(load["arads_cache"]["load"], t);
							st.setItem(load["arads_cache"]["load"] + '_time', d.setTime(d.getTime() + (time *60*60*1000)));
							
							if (callback != null) {
								return callback(rt);
							}
						}
					}else{
						let a = $(document).find(".container").before('<section class="tsr-alert tsr-alert-error tsr-p10px"> Wystąpił błąd pod czas dodawania zawartośći cache! </section>');
						$(a[0].previousSibling).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
					}
					
					
					return (t);
				});
				
				if (cache == false) {
					$(document).find(".container").before('<section class="tsr-alert tsr-alert-error tsr-p10px"> Wystąpił błąd pod czas pobieranie zawartośći cache! </section>');
					console.error("arads-cache: " + load);
					return false;
				}else {
					console.log ("arads-cache: All done!");	
					return true;					
				}
			};
			
			function get () {
				if (st.getItem(load["arads_cache"]["load"] + '_time')) {
					if (Date.now() >= st.getItem(load["arads_cache"]["load"] + '_time')) {
						st.removeItem(load["arads_cache"]["load"]);
						st.removeItem(load["arads_cache"]["load"] + '_time');
						return arads_cache(load, time, callback, s, exe, inte);
					}else{
						if (callback != null) {
							return callback(JSON.parse(st.getItem(load["arads_cache"]["load"])));
						}
					}
				}else{
					st.setItem(load["arads_cache"]["load"] + '_time', d.setTime(d.getTime() + (time)));
					return true;
				}
			}
			
		}else{
			console.error("arads-cache: Przeglądarka nie wspiera localStorage! Dłuższe czasy ładowania!");
			return false;
		}
	}
	
	function storageAvailable(type) {
		var storage;
		try {
			storage = window[type];
			var x = '__arads_storage_test__';
			storage.setItem(x, x);
			storage.removeItem(x);
			return true;
		}
		catch(e) {
			return e instanceof DOMException && (
				// everything except Firefox
				e.code === 22 ||
				// Firefox
				e.code === 1014 ||
				// test name field too, because code might not be present
				// everything except Firefox
				e.name === 'QuotaExceededError' ||
				// Firefox
				e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
				// acknowledge QuotaExceededError only if there's something already stored
				(storage && storage.length !== 0);
		}
	}