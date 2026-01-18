<h2 class="text-center mb-4">Quản lý Sinh Viên (MVC + Ajax)</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0" id="form-title">Thêm mới sinh viên</h5>
            </div>
            <div class="card-body">
                <form id="student-form">
                    <input type="hidden" id="student_id" name="id">
                    <input type="hidden" id="action_type" name="action" value="create">
                    
                    <div class="mb-3">
                        <label>Mã SV <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="code" name="code">
                        <small class="text-danger error-msg" id="error-code"></small>
                    </div>

                    <div class="mb-3">
                        <label>Họ tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                        <small class="text-danger error-msg" id="error-full_name"></small>
                    </div>

                    <div class="mb-3">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email">
                        <small class="text-danger error-msg" id="error-email"></small>
                    </div>

                    <div class="mb-3">
                        <label>Ngày sinh</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>

                    <div class="alert alert-danger d-none" id="general-error"></div>

                    <button type="submit" class="btn btn-success w-100" id="btn-save">Lưu lại</button>
                    <button type="button" class="btn btn-secondary w-100 mt-2 d-none" id="btn-cancel">Hủy bỏ</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="student-list">
                </tbody>
        </table>
    </div>
</div>