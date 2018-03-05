<footer class="container" style="margin-top: 50px;">
	
		<p class="text-center">@2018 Campagin Solution</p>
		
	</footer>

	


	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datetimepicker/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
	

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


		$(document).on('click', '#save_add_prize', function() {
			$.post('<?php echo site_url('member/save_add_prize');?>', $("#frmsaveprize").serialize(), function() {
				top.location.reload();
			});
		});

		$(document).on('click', '#checkall', function() {
			$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
		})


		$(document).on('click', '#save_update_prize', function() {
			$.post('<?php echo site_url('member/update_add_prize');?>', $("#frmupdateprize").serialize(), function() {
				top.location.reload();
			});
		});


		$(document).on('click', '#save_member', function() {
				
			$.post('<?php echo site_url('member/save_member');?>', { 
				'campaign_id': $("#campaign_id").val(),
				'staff_code': $("#staff_code").val(),
				'staff_id': $("#staff_id").val(),
				'name': $("#name").val(),
				'email': $("#email").val(),
				'dep_name': $("#dep_name").val(),
				'email': $("#email").val(),
				'mobile': $("#mobile").val(),
				'position': $("#position").val(),
				'checkin': $("#checkin:checked").val(),
				'no_prize': $("#no_prize:checked").val(),
				'shop_name': $("#shop_name").val(),
				'note': $("#note").val(),
			 }, function(res) {
				
				top.location.reload();
			})
		});

		$(document).on('click', '#save_member_edit', function() {
				
			$.post('<?php echo site_url('member/update_member');?>', { 
				'id': $("#id").val(),
				'campaign_id': $("#campaign_id").val(),
				'staff_id': $("#staff_id").val(),
				'staff_code': $("#staff_code").val(),
				'name': $("#name").val(),
				'email': $("#email").val(),
				'dep_name': $("#dep_name").val(),
				'email': $("#email").val(),
				'mobile': $("#mobile").val(),
				'position': $("#position").val(),
				'checkin': $("#checkin:checked").val(),
				'no_prize': $("#no_prize:checked").val(),
				'shop_name': $("#shop_name").val(),
				'note': $("#note").val(),
			 }, function(res) {
				
				top.location.reload();
			})
		});





		$(function() {

			$("#myModal").on('show.bs.modal', function(e) {
	           var link = $(e.relatedTarget);
	           $(this).find('.modal-content').load(link.attr('href'));
	        })


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

		

	</script>

</body>
</html>