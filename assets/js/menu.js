$(() => {
	loadSidebar();
})

const loadSidebar = () => {
	let container;

	if (SIDEBAR === 'vertical') {
		container = $('#side-menu');
		container.empty();

		$.get(BASE_URL + 'loadMenu').then((res) => {
			const { data } = res;
			for (const group of data) {
				let { nama, menus } = group;
				if (menus.length > 0) {
					container.append(`<li class="menu-title" key="t-pages">${nama}</li>`);
					for (const menu of menus) {

						let { nama, icon, route, id, child } = menu;

						if (child.length > 0) {
							let label = $('<span>', {
								key: ("t-" + nama).replaceAll(' ', '_').toLowerCase(),
								text: capitalizeFirstLetter(nama)
							});

							let menu_icon = $('<i>', {
								class: icon
							});

							let a = $('<a>', {
								href: "javascript:void(0);",
								class: 'has-arrow waves-effect ' + MENU_ACTIVE === nama ? 'font-weight-bold' : '',
								html: [menu_icon, label]
							});

							let sub = $('<ul>', {
								class: 'sub-menu',
								'aria-expanded': false,
							});

							for (const item of child) {
								let { nama, route, id } = item;
								let li = $('<li>', {
									class: MENU_ACTIVE === nama ? 'mm-active' : '',
									html: $('<a>', {
										href: BASE_URL + route + '/' + id,
										text: capitalizeFirstLetter(nama),
									})
								})

								sub.append(li.prop('outerHTML'));
							}

							container.append($('<li>', {
								class: MENU_OPEN === nama ? 'mm-active' : '',
								html: [a, sub],
							}).prop('outerHTML'));
						} else {
							let label = $('<span>', {
								text: capitalizeFirstLetter(nama),
								key: ("t-" + nama).replaceAll(' ', '_').toLowerCase(),
							});

							let menu_icon = $('<i>', {
								class: icon
							});

							let a = $('<a>', {
								href: BASE_URL + route + '/' + id,
								html: [menu_icon, label],
							});

							container.append($('<li>', {
								class: MENU_ACTIVE === nama ? 'mm-active' : '',
								html: [a],
							}).prop('outerHTML'));
						}
					}
				}

			}

			$('#side-menu').metisMenu('dispose');
			$('#side-menu').metisMenu();
		})

	} else if (SIDEBAR === 'horizontal') {
		container = $('#top-menu');
		container.empty();

		$.get(BASE_URL + 'loadMenu').then((res) => {
			const { data } = res;

			for (const parent of data) {
				let { nama, icon, route, id, child } = parent;


				if (child.length > 0) {

					let arrow_down = $('<div>', {
						class: 'arrow-down'
					})

					let label = $('<span>', {
						key: ("t-" + nama).replaceAll(' ', '_').toLowerCase(),
						text: capitalizeFirstLetter(nama)
					});

					let menu_icon = $('<i>', {
						class: icon
					});

					let a = $('<a>', {
						id: ("topnav-" + nama).replaceAll(' ', '_').toLowerCase(),
						href: "javascript:void(0);",
						class: 'nav-link dropdown-toggle arrow-none',
						html: [menu_icon, ' ', label, arrow_down],
						role: 'button',
						"data-toggle": 'dropdown',
						"aria-haspopup": true,
						"aria-expanded": false
					});

					let sub = $('<div>', {
						class: 'dropdown-menu',
						'aria-labelledby': ("topnav-" + nama).replaceAll(' ', '_').toLowerCase(),
					});

					for (const item of child) {
						let { nama: nama_child, route: route_child, id: id_child } = item;
						let aa = $('<a>', {
							class: (MENU_ACTIVE === nama_child ? 'active font-weight-bold' : '') + ' dropdown-item',
							href: BASE_URL + route_child + '/' + id_child,
							html: capitalizeFirstLetter(nama_child),
							key: ("t-" + nama_child).replaceAll(' ', '_').toLowerCase()
						})

						sub.append(aa.prop('outerHTML'));
					}

					container.append($('<li>', {
						class: (MENU_OPEN === nama ? 'active font-weight-bold' : '') + ' nav-item dropdown',
						html: [a, sub],
					}).prop('outerHTML'));

				} else {

					let label = $('<span>', {
						text: capitalizeFirstLetter(nama),
						key: ("t-" + nama).replaceAll(' ', '_').toLowerCase(),
					});

					let menu_icon = $('<i>', {
						class: icon
					});

					let a = $('<a>', {
						id: ("topnav-" + nama).replaceAll(' ', '_').toLowerCase(),
						href: BASE_URL + route + '/' + id,
						html: [menu_icon, ' ', label],
						class: 'nav-link arrow-none'
					});

					container.append($('<li>', {
						class: (MENU_ACTIVE === nama ? 'active font-weight-bold' : '') + ' dropdown nav-item',
						html: [a],
					}).prop('outerHTML'));
				}
			}

		})
	}
}
