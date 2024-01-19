function favoriteInit() {
	var favorites = document.querySelectorAll('.js-favorite');
	favorites.forEach(function (item) {
		item.addEventListener('click', function (e) {
			e.preventDefault();
			var iblockId = item.getAttribute('data-iblock-id');
			var favoriteEntity = item.getAttribute('data-favorite-entity');
			if (typeof iblockId === "undefined") {
				console.log('attribute `data-iblock-id` undefined');
				return;
			}
			if (typeof favoriteEntity === "undefined") {
				console.log('attribute `data-favorite-entity` undefined');
				return;
			}
			BX.ajax.runAction('neti:favorite.controllers.favorite.sendData', {
				data: {
					favoriteEntityId: favoriteEntity,
					iblockId: iblockId
				}
			}).then(function (response) {
				var addClasses = response.data.classAdd.split(' ');
				var removeClasses = response.data.classDelete.split(' ');
				removeClasses.forEach(function (cssClass) {
					item.classList.remove(cssClass);
				});
				addClasses.forEach(function (cssClass) {
					item.classList.add(cssClass);
				});
				var count = document.querySelector('#neti_favorites_equation .count');
				if (count) {
					count.textContent = response.data.count;
				}
				BX.onCustomEvent('controllers-netiFavoriteSendData:success', response);
			})["catch"](function (response) {
				console.log(response);
				BX.onCustomEvent('controllers-netiFavoriteSendData:error', response);
			});
		});
	});
	BX.ajax.runAction('neti:favorite.controllers.favorite.setStatus', {
		method: 'get',
		data: {}
	}).then(function (response) {
		var count = document.querySelector('#neti_favorites_equation .count');
		if (count) {
			count.textContent = response.data.ids.length;
		}
		var favorites = document.querySelectorAll('.js-favorite');
		favorites.forEach(function (item) {
			if (response.data.ids === []) {
				return true;
			}
			var elementId = item.getAttribute('data-favorite-entity');
			var ids = response.data.ids;
			var elementFound = false;
			ids.forEach(function (id) {
				if (elementId == id) {
					elementFound = true;
				}
			});

			// Удаляем класс по умолчанию
			var removeClasses = response.data.removeClass.split(' ');
			removeClasses.forEach(function (cssClass) {
				item.classList.remove(cssClass);
			});

			//Добавляем класс товарам из избранного
			var addClasses = response.data.addClass.split(' ');
			if (elementFound) {
				addClasses.forEach(function (cssClass) {
					item.classList.add(cssClass);
				});
				return;
			}

			//Добавляем класс товарам которые не в избранном
			removeClasses.forEach(function (cssClass) {
				item.classList.add(cssClass);
			});
		});
		BX.onCustomEvent('controllers-netiFavoriteSetStatus:success', response);
	})["catch"](function (response) {
		console.log(response);
		BX.onCustomEvent('controllers-netiFavoriteSetStatus:error', response);
	});

	let cleanButton = document.querySelector('.js-favorite-clean');
	if (cleanButton) {
		cleanButton.addEventListener('click', (e) => {
			e.preventDefault();
			BX.ajax.runAction('neti:favorite.controllers.favorite.allClean', {
				method: 'post',
				data: {}
			}).then(function (response) {
				var count = document.querySelector('#neti_favorites_equation .count');
				if (count) {
					count.textContent = 0;
				}
				location.reload();
				BX.onCustomEvent('controllers-netiFavoriteAllClean:success')
			})["catch"](function (response) {
				console.log(response)
				BX.onCustomEvent('controllers-netiFavoriteAllClean:error')
			})
		})
	}
}

BX.ready(function () {
	favoriteInit();
});