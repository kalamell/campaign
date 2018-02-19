<footer class="container" style="margin-top: 50px;">
	
		<p class="text-center">@2018 Campagin Solution</p>
		
	</footer>

	


	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datetimepicker/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpKdMqkUBho4XDmt4SiAAvTSB1cVJ-U5I&signed_in=true&callback=initMap" type="text/javascript"></script>


	<script type="text/javascript">
		jQuery.extend(jQuery.validator.messages, {
		    required: "** กรุณากรอก.",
		    remote: "มีผู้ใช้งานแล้ว",
		    email: "Please enter a valid email address.",
		    url: "Please enter a valid URL.",
		    date: "Please enter a valid date.",
		    dateISO: "Please enter a valid date (ISO).",
		    number: "Please enter a valid number.",
		    digits: "Please enter only digits.",
		    creditcard: "Please enter a valid credit card number.",
		    equalTo: "รหัสผ่านยืนยันไม่ตรงกัน",
		    accept: "Please enter a value with a valid extension.",
		    maxlength: jQuery.validator.format("กรอกได้สูงสุด {0} ตัวอักษร."),
		    minlength: jQuery.validator.format("กรอกต่ำสุด {0} ตัวอักษร."),
		    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
		    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
		    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
		    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
		});
		$(function() {

			$("#md").on('show.bs.modal', function(e) {
	           // e.preventDefault();
	            var link = $(e.relatedTarget);
	           
	            $(this).find('.modal-body').load(link.attr('href'));
	        })

			$("#save_room").on('click', function() {
				
				$.post('<?php echo site_url('member/save_room');?>', { 
					'term_id': '<?php echo $this->uri->segment(3);?>',
					'year_id': '<?php echo $this->uri->segment(4);?>',
					'room_no': $("#room_no").val(),
					'room_boy': $("#room_boy").val(),
					'room_girl': $("#room_girl").val(),
					'rmid': $("#rmid").val(),
				 }, function() {
					top.location.href="<?php echo site_url('member/school/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'#tab7');?>";
					top.location.reload();
				})
			});


			if(window.location.hash != "") {
			      $('a[href="' + window.location.hash + '"]').click();
			      return false;
			  }

			$(".date").datetimepicker({
				format: 'YYYY-MM-DD'
			});

			$("select[name=province_id]").on('change', function() {
				var val = $(this).val();
				$.post('<?php echo site_url('auth/getamphur');?>', { province_id: val }, function(res) {
					$("select[name=amphur_id]").html('<option value=""> อำเภอ </option>');
					$.each(res, function(key, value) {
						$('<option value="' + value.AMPHUR_ID +'">' + value.AMPHUR_NAME + '</option>').appendTo($("select[name=amphur_id]"));
					});
				}, 'json');
			})

			$("select[name=amphur_id]").on('change', function() {
				var val = $(this).val();
				$.post('<?php echo site_url('auth/getdistrict');?>', { amphur_id : val }, function(res) {
					$("select[name=district_id]").html('<option value=""> ตำบล </option>');
					$.each(res, function(key, value) {
						$('<option value="' + value.DISTRICT_ID +'">' + value.DISTRICT_NAME + '</option>').appendTo($("select[name=district_id]"));
					});
				}, 'json');
			})

			$("select#area").on('change', function() {
		      var val = $(this).val();
		      $.post('<?php echo site_url('auth/list_school');?>', { area: val }, function(res) {
		        var opt = '';
		        $("select[name=school]").html('<option value="">- - - โรงเรียน - - -</option>')
		        $.each(res, function(key, val) {
		          otp = '<option value="' + val.school_id + '">' + val.school_name + '</option>';
		          $("select[name=school]").append(otp);

		        })
		      }, 'json');
		    });

		    $("form#login").validate();
		    $("form#frmadd").validate();
		    $("form#register").validate({
		      rules: {
		        username: {
		          required: true,
		          remote: '<?php echo site_url('auth/check_idcard');?>'
		        },

		        email: {
		          required: true,
		          email: true,
		          remote: '<?php echo site_url('auth/check_email');?>'
		        },

		        confirm_password: {
		          equalTo: "#password"
		        }
		      },
		      submitHandler: function(form) {
		        $.post($(form).attr('action'), $(form).serialize(), function(res) {
		          if (res.result) {
		            $(".alert").html('<strong>บันทึกข้อมูลเรียบร้อย</strong><br><a href="<?php echo site_url('login');?>">กดที่นี่เพื่อเข้าสู่ระบบ</a>');
		            $(".alert").removeClass('alert-danger').addClass('alert-success').show();
		            $(".alert").show();
		          } else {
		            $(".alert").html(res.msg);
		            $(".alert").removeClass('alert-success').addClass('alert-danger').show();
		          }
		          $("html, body").animate({ scrollTop: 0 }, 1000);


		        }, 'json');
		      }
		    });

		    $("form#memberupdate").validate({
		      rules: {
		        
		        confirm_password: {
		          equalTo: "#password"
		        }
		      },
		      submitHandler: function(form) {
		        $(form).submit();
		      }
		    });


		});

		$(function() {
			//getSchool();

			$("a.delete-level").on('click', function() {
				var ssid = $(this).attr('data-id');
				var conf = confirm('ต้องการลบหรือไม่');

				if (conf) {

					$.post('<?php echo site_url('member/delete_level');?>', { ssid, ssid }, function() {
						top.location.reload();
					});
				}
			})

			$("#list_area_id").on('change', function() {
				getSchool();
			})

			$("#save_level").on('click', function() {
				var data = {
					level: $("#level").val(),
					boy: $("#boy").val(),
					girl: $("#girl").val(),
					school_main_name: $("#school_main_name").val()
				}
				$.post('<?php echo site_url('member/save_room_level');?>', data, function() {
					top.location.href="<?php echo site_url('member/school/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'#tab2');?>"
					top.location.reload();
				});
			})
		})

		function getSchool() {
			var area_id = $("#list_area_id").val();
			$("#school_sub_id").html('<option value=""> เลือกโรงเรียน </option>');
			$.post('<?php echo site_url('auth/list_school_area');?>', { area_id : area_id }, function(res) {
				$.each(res, function(key, v) {
					$('<option value="' + v.school_id +'">' + v.school_name + '</option>').appendTo($("#school_sub_id"));
				});
			}, 'json');
		}

	</script>

</body>
</html>