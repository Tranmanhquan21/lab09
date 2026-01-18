$(document).ready(function() {
    // 1. Cấu hình đường dẫn gốc (Quan trọng nhất)
    const BASE_URL = '/project/public/index.php';

    console.log("App.js đã chạy! Base URL: " + BASE_URL);

    // Load danh sách ngay khi vào trang
    loadStudents();

    // --- HÀM LOAD DANH SÁCH ---
    function loadStudents() {
        $.ajax({
            url: BASE_URL + '?c=Student&a=api&action=list',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    let rows = '';
                    response.data.forEach((sv, index) => {
                        rows += `<tr>
                            <td>${index + 1}</td>
                            <td>${sv.code}</td>
                            <td>${sv.full_name}</td>
                            <td>${sv.email}</td>
                            <td>${sv.dob}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit" data-id="${sv.id}">Sửa</button>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${sv.id}">Xóa</button>
                            </td>
                        </tr>`;
                    });
                    $('#student-list').html(rows);
                }
            },
            error: function(xhr) { console.log('Lỗi load:', xhr.responseText); }
        });
    }

    // --- XỬ LÝ NÚT LƯU (Chặn reload trang) ---
    $('#student-form').submit(function(e) {
        e.preventDefault();
        
        let formData = $(this).serialize();
        
        $.ajax({
            url: BASE_URL + '?c=Student&a=api',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    alert(res.message);
                    loadStudents();
                    $('#student-form')[0].reset();
                    resetForm();
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("Lỗi hệ thống. Xem Console (F12)");
            }
        });
    });

    // --- XỬ LÝ NÚT SỬA (LẤY DỮ LIỆU ĐƯA LÊN FORM) ---
    $(document).on('click', '.btn-edit', function() {
        let id = $(this).data('id');
        
        $.ajax({
            url: BASE_URL + '?c=Student&a=api&action=get_one&id=' + id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    let sv = res.data;
                    $('#student_id').val(sv.id);
                    $('#code').val(sv.code);
                    $('#full_name').val(sv.full_name);
                    $('#email').val(sv.email);
                    $('#dob').val(sv.dob);
                    
                    $('#action_type').val('update');
                    $('#form-title').text('Cập nhật sinh viên');
                    $('#btn-save').text('Cập nhật');
                    $('#btn-cancel').removeClass('d-none');
                    
                    // Scroll to form
                    $('html, body').animate({scrollTop: $('#student-form').offset().top - 50}, 500);
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr) {
                console.log("Lỗi lấy thông tin sửa:", xhr.responseText);
                alert("Lỗi lấy thông tin sinh viên");
            }
        });
    });

    // --- XỬ LÝ NÚT HỦY (QUAY VỀ THÊM MỚI) ---
    $(document).on('click', '#btn-cancel', function() {
        resetForm();
    });

    function resetForm() {
        $('#student-form')[0].reset();
        $('#student_id').val('');
        $('#action_type').val('create');
        $('#form-title').text('Thêm mới sinh viên');
        $('#btn-save').text('Lưu lại');
        $('#btn-cancel').addClass('d-none');
        $('.error-msg').text('');
        $('#general-error').addClass('d-none');
    }

    // --- XỬ LÝ NÚT XÓA ---
    $(document).on('click', '.btn-delete', function() {
        if(confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')) {
            let id = $(this).data('id');
            
            $.ajax({
                url: BASE_URL + '?c=Student&a=api',
                type: 'POST',
                data: { action: 'delete', id: id },
                dataType: 'json',
                success: function(res) {
                    if(res.success) {
                        alert(res.message);
                        loadStudents();
                    } else {
                        alert('Lỗi: ' + res.message);
                    }
                },
                error: function(xhr) {
                    console.log("Lỗi xóa:", xhr.responseText);
                    alert("Không thể xóa sinh viên này.");
                }
            });
        }
    });

});
