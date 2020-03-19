$("#jurusan").on("change", function () {
	var jurusan = this.value;
	let a = "";
	let b = "";

	$.ajax({
		url: "http://localhost/lsp-ciamis/admin/cari_jurusan",
		type: "POST",
		dataType: "html",
		data: {
			jurusan: jurusan
		},
		success: function (data) {
			$("#tampil").html(data);

			a = document.getElementById("nilai_k").value;
			b = document.getElementById("nilai_bk").value;
			new Morris.Bar({
				// ID of the element in which to draw the chart.
				element: "myfirstchart",
				// Chart data records -- each entry in this array corresponds to a point on
				// the chart.
				data: [
					{ nilai: "BK", value: b },
					{ nilai: "K", value: a }
				],
				// The name of the data record attribute that contains x-values.
				xkey: "nilai",
				// A list of names of data record attributes that contain y-values.
				ykeys: ["value"],
				// Labels for the ykeys -- will be displayed when you hover over the
				// chart.
				labels: ["Value"]
			});
		}
	});
});

let woilah_k = document.getElementById("woilah_k").value;
let woilah_bk = document.getElementById("woilah_bk").value;

$(document).ready(function () {
	new Morris.Donut({
		// ID of the element in which to draw the chart.
		element: "pienilai",
		// Chart data records -- each entry in this array corresponds to a point on
		// the chart.
		data: [
			{ label: "BK", value: woilah_bk },
			{ label: "K", value: woilah_k }
		]
		// The name of the data record attribute that contains x-values.
		// chart.
	});
});
