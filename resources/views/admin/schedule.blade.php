<!DOCTYPE html>
<html>
<head>
    <title>Tạo lịch học</title>
    <style>
        /* CSS cho giao diện */
        .form-group {
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>Tạo lịch học</h1>
<form id="scheduleForm">
    <div class="form-group">
        <label for="startDate">Ngày bắt đầu:</label>
        <input type="date" id="startDate" name="startDate" required>
    </div>
    <div class="form-group">
        <label for="endDate">Ngày kết thúc:</label>
        <input type="date" id="endDate" name="endDate" required>
    </div>
    <div class="form-group">
        <label for="classSchedules">Lịch học của các lớp:</label>
        <div id="classSchedules">
            <div class="class-schedule">
                <div class="form-group">
                    <label for="classId">Lớp học:</label>
                    <select id="classId" name="classId[]" required>
                        <option value="">Chọn lớp học</option>
                        <!-- Thêm các tùy chọn cho các lớp học từ cơ sở dữ liệu -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="classDays">Ngày học:</label>
                    <select id="classDays" name="classDays[]" multiple required>
                        <option value="1">Thứ 2</option>
                        <option value="2">Thứ 3</option>
                        <option value="3">Thứ 4</option>
                        <option value="4">Thứ 5</option>
                        <option value="5">Thứ 6</option>
                        <option value="6">Thứ 7</option>
                        <option value="7">Chủ nhật</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="startTime">Thời gian bắt đầu:</label>
                    <input type="time" id="startTime" name="startTime[]" required>
                </div>
                <div class="form-group">
                    <label for="endTime">Thời gian kết thúc:</label>
                    <input type="time" id="endTime" name="endTime[]" required>
                </div>
            </div>
        </div>
        <button type="button" id="addScheduleBtn">Thêm lịch học</button>
    </div>
    <button type="submit" class="btn">Tạo lịch học</button>
</form>

<script>
    // JavaScript để thêm và xóa lịch học
    document.getElementById('addScheduleBtn').addEventListener('click', function () {
        var classSchedule = document.querySelector('.class-schedule').cloneNode(true);
        classSchedule.querySelector('select[name="classId[]"]').selectedIndex = 0;
        classSchedule.querySelector('select[name="classDays[]"]').selectedIndex = 0;
        classSchedule.querySelector('input[name="startTime[]"]').value = '';
        classSchedule.querySelector('input[name="endTime[]"]').value = '';
        document.getElementById('classSchedules').appendChild(classSchedule);
    });

    document.getElementById('scheduleForm').addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('remove-schedule')) {
            event.target.closest('.class-schedule').remove();
        }
    });
</script>
</body>
</html>
