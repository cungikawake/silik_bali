var Laporan = {};

Laporan.bootgridPenugasanList = function () {
	$("#grid-penugasan-list").bootgrid({
		rowCount: 15,
		templates: {
			actionDropDown: "",
			search: "",
			infos: ""
		},
		converters: {
			currency: {
				from: function (value) { return +value; },
				to: function (value) { return 'Rp. '+parseFloat(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }
			}
		}
	});
}

Laporan.bootgridPenugasanList();