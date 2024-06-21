const csrfToken = document.getElementById('csrf-token').value;
$(document).ready(function() {
    $(document).ready(function() {
        // Обработчик нажатия кнопки "Редактировать отзыв"
        $('.edit-review-btn').click(function() {
            var reviewId = $(this).data('review-id');
            var reviewContent = $(this).data('review-content');

            // Заполнение формы редактирования отзыва в модальном окне
            $('#reviewId').val(reviewId);
            $('#editedReviewContent').val(reviewContent);
        });
    });
    // Обработчик нажатия кнопки "Сохранить изменения"
    $('#saveReviewChanges').click(function() {
        var reviewId = $('#reviewId').val();
        var editedReviewContent = $('#editedReviewContent').val();

        // Отправка AJAX-запроса на сервер для обновления отзыва
        $.ajax({
            url: '/update-status/' + reviewId,
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Передача CSRF-токена в заголовке запроса
            },
            data: {
                content: editedReviewContent,

            },
            success: function(response) {
                // Обновление отображения отзыва на странице
                // Например, обновление текста отзыва
                $('#reviewContent-' + reviewId).text(editedReviewContent);
                console.log($('#reviewContent-' + reviewId));
                // Закрытие модального окна
                $('#editReviewModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
