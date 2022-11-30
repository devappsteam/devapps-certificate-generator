(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(window).load(function () {
		sessionStorage.removeItem("certificate_model");
		sessionStorage.removeItem("certificate_persons");
		sessionStorage.removeItem("certificate_course");

		// Person
		var fullname = $('#person_name');
		var document = $('#person_cpf');
		var email = $('#person_email');

		//Course
		var course_name = $('#course_name');
		var course_instructor = $('#course_instructor');
		var course_date = $('#course_date');
		var course_locale = $('#course_locale');
		var course_time = $('#course_time');

		const uuid = () => {
			var dt = new Date().getTime();
			var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
				var r = (dt + Math.random() * 16) % 16 | 0;
				dt = Math.floor(dt / 16);
				return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
			});
			return uuid;
		};

		const clear_person_form = () => {
			fullname.val(null).removeClass('is-valid').removeClass('is-invalid');
			document.val(null).removeClass('is-valid').removeClass('is-invalid');
			email.val(null).removeClass('is-valid').removeClass('is-invalid');
		};

		const create_tr_person = () => {
			let code = uuid();
			$('#person_table tbody').append(`
				<tr id="${code}">
					<td>${fullname.val()}</td>
					<td>${document.val()}</td>
					<td>${email.val()}</td>
					<td>
						<button type="button" class="btn btn-danger btn_remove btn-sm" data-code="${code}">Remover</button>
					</td>
				</tr>
			`);
		};

		const toggle_empty_message = () => {
			if ($('#person_table tbody').find('tr').not('#empty_table').length > 0) {
				$('#empty_table').hide();
				$(".btn-next.person").prop('disabled', false);
			} else {
				$('#empty_table').show();
				$(".btn-next.person").prop('disabled', true);
			}
		};

		const check_course_tab = () => {
			if (course_name.val().trim() != "" && course_instructor.val().trim() != "" && course_date.val().trim() != "" && course_time.val().trim() != "") {
				$(".btn-next.course").prop('disabled', false);
			} else {
				$(".btn-next.course").prop('disabled', true);
			}
		};


		const save_data_on_change_tab = (previus_tab) => {
			switch ($(previus_tab).data('target')) {
				case "#pills-models":
					sessionStorage.setItem('certificate_model', $('input[name="model"]:checked').val());
					$(previus_tab).addClass('success');
					break;
				case "#pills-person":
					let persons = [];

					$('#person_table tbody').find('tr').not('#empty_table').each(function (index, item) {
						persons.push({
							fullname: $(item).find('td').eq(0).text(),
							document: $(item).find('td').eq(1).text(),
							email: $(item).find('td').eq(2).text(),
						});
					});
					sessionStorage.setItem('certificate_persons', JSON.stringify(persons));
					break;
				case "#pills-course":
					sessionStorage.setItem('certificate_course', JSON.stringify({
						name: course_name.val(),
						instructor: course_instructor.val(),
						data: course_date.val(),
						locale: course_locale.val(),
						time: course_time.val()
					}));
					break;
			}
		};

		const create_preview_generate = (target) => {
			if ($(target).data('target') == "#pills-generate") {
				$('#preview_generate tbody').html(null);
				let persons = JSON.parse(sessionStorage.getItem('certificate_persons'));

				persons.forEach((item, index) => {
					$('#preview_generate tbody').append(`
						<tr id="preview_${index}">
							<td>${(index + 1)}</td>
							<td>${item.fullname}</td>
							<td>${item.document}</td>
							<td>${item.email}</td>
							<td>
								<span class="badge badge-secondary p-2">Não Iniciado</span>
							</td>
							<td>
								${(index == 0) ? '<button type="button" class="btn btn-primary btn-sm btn_generate_preview" data-index="' + index + '">Visualizar</a>' : ''}
							</td>
						</tr>
					`);
				});

				$('.btn-generate').prop('disabled', false);
			}
		}

		const generate_ajax = (data) => {
			$.ajax({
				url: devapps_certificate_generator.ajax,
				dataType: 'JSON',
				type: "POST",
				data: data,
				beforeSend: function () {
					$('#preview_generate tbody').find('tr').eq(data.index).find('td').eq(4).html(`
						<span class="badge badge-warning p-2">Processando</span>
					`);
				},
				success: function (response) {
					if (response.status) {
						$('#preview_generate tbody').find('tr').eq(data.index).find('td').eq(4).html(`
							<span class="badge badge-success p-2">Concluído</span>
						`);

						$('#preview_generate tbody').find('tr').eq(data.index).find('td').eq(5).html(`
							<a href="${response.url}" class="btn btn-sm btn-success" download="${response.filename}">Download</a>
						`);
					}
				}
			});
		}

		const process_ajax = async (preview = 0) => {

			let model = sessionStorage.getItem('certificate_model');
			let persons = JSON.parse(sessionStorage.getItem('certificate_persons'));
			let course = JSON.parse(sessionStorage.getItem('certificate_course'));
			let count = 0;

			for (var item of persons) {
				await generate_ajax({
					action: 'generate_certificate',
					index: count,
					model: model,
					person: item,
					course: course,
					preview: preview
				});
				if (preview) {
					break;
				}
				count++;
			};
		};

		$('.btn-next').on('click', function (e) {
			e.preventDefault();
			var next = $('.nav-pills .active').parent().next('li').find('button');
			next.prop('disabled', false);
			next.trigger('click');
		});

		$('.btn-prev').on('click', function (e) {
			e.preventDefault();
			var prev = $('.nav-pills .active').parent().prev('li').find('button');
			prev.trigger('click');
		});

		$('button[data-toggle="pill"]').on('shown.bs.tab', function (event) {
			create_preview_generate(event.target);
			save_data_on_change_tab(event.relatedTarget);
		});

		$('.model-check').on('change', function (e) {
			$(".btn-next.models").prop('disabled', false);
		});

		fullname.on('input', function () {
			if (fullname.val().trim() == "") {
				fullname.addClass('is-invalid');
			} else {
				fullname.addClass('is-valid').removeClass('is-invalid');
			}
		});

		document.on('input', function () {
			if (document.val().trim() == "") {
				document.addClass('is-invalid');
			} else {
				document.addClass('is-valid').removeClass('is-invalid');
			}
		});

		email.on('input', function () {
			if (!email.is(':valid')) {
				email.addClass('is-invalid');
			} else {
				email.addClass('is-valid').removeClass('is-invalid');
			}
		});

		$('#btn_add_person').on('click', function (e) {
			e.preventDefault();

			let fullname_valid = false;
			let document_valid = false;
			let email_valid = false;

			if (fullname.val().trim() != "") {
				fullname_valid = true;
				fullname.addClass('is-valid').removeClass('is-invalid');
			} else {
				fullname.addClass('is-invalid');
			}

			if (document.val().trim() != "") {
				document_valid = true;
				document.addClass('is-valid').removeClass('is-invalid');
			} else {
				document.addClass('is-invalid');
			}

			if (email.is(':valid')) {
				email_valid = true;
				email.addClass('is-valid').removeClass('is-invalid');
			} else {
				email.addClass('is-invalid');
			}

			if (fullname_valid && document_valid && email_valid) {
				create_tr_person();
				clear_person_form();
				toggle_empty_message();
			}

		});

		$('body').on('click', '.btn_remove', function (e) {
			e.preventDefault();
			$('#person_table tbody').find(`#${$(this).data('code')}`).remove();
			toggle_empty_message();
		});



		course_name.on('input', function () {
			if (course_name.val().trim() == "") {
				course_name.addClass('is-invalid');
			} else {
				course_name.addClass('is-valid').removeClass('is-invalid');
			}
			check_course_tab();
		});

		course_instructor.on('input', function () {
			if (course_instructor.val().trim() == "") {
				course_instructor.addClass('is-invalid');
			} else {
				course_instructor.addClass('is-valid').removeClass('is-invalid');
			}
			check_course_tab();
		});

		course_date.on('input', function () {
			if (course_date.val().trim() == "") {
				course_date.addClass('is-invalid');
			} else {
				course_date.addClass('is-valid').removeClass('is-invalid');
			}
			check_course_tab();
		});

		course_time.on('input', function () {
			if (course_time.val().trim() == "") {
				course_time.addClass('is-invalid');
			} else {
				course_time.addClass('is-valid').removeClass('is-invalid');
			}
			check_course_tab();
		});


		$('.btn-generate').on('click', function (e) {
			e.preventDefault();
			$('.btn-generate').prop('disabled', true);
			process_ajax(0);
		});

		$('body').on('click', '.btn_generate_preview', function(e){
			e.preventDefault();
			process_ajax(1);
		})

	});

})(jQuery);
