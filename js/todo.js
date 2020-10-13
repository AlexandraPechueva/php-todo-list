jQuery(document).ready(function () {
    var todoListItem = jQuery('.todo-list');
    var todoListInput = jQuery('.todo-list-input');
    var submitButton = jQuery('.todo-list-add-btn').attr("disabled", true);
    var errorMessage = jQuery('.error-message');
    var taskCount = jQuery('.tasks-count');

    jQuery(todoListInput).on('propertychange input', function () {
        var valid = true;

        if (!$(todoListInput).val()) {
            valid = false;
        }

        if (valid) {
            submitButton.attr("disabled", false);
            errorMessage.addClass('hidden');
        }
        else {
            submitButton.attr("disabled", true);
            errorMessage.removeClass('hidden');
        }
    });

    // create
    jQuery('.todo-list-add-btn').on("click", function (event) {
        event.preventDefault();

        var action = 'create';
        var item = todoListInput.val();
        var bindHTML = '';

        jQuery.ajax({
            type: 'POST',
            url: 'action.php',
            data: { action: action, title: item },
            dataType: 'json',
            success: function (json) {
                if (item) {
                    bindHTML += '<li>';
                    bindHTML += '<div class="form-check">';
                    bindHTML += '<label class="form-check-label">';
                    bindHTML += '<input class="checkbox" type="checkbox" data-utaskid="' + json.task_id + '" />' + item;
                    bindHTML += '<span class="checkmark"></span>';
                    bindHTML += '</label>';
                    bindHTML += '</div>';
                    bindHTML += '</li>';
                    todoListItem.append(bindHTML);
                    todoListInput.val("");
                    submitButton.attr("disabled", true);
                    taskCount.text(parseInt(taskCount.text()) + 1);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    // update
    todoListItem.on('change', '.checkbox', function () {
        var action = 'update';
        var task_id = jQuery(this).data('utaskid');
        var doneList = jQuery('.done-list');
        var doneHTML = '';

        if (jQuery(this).attr('checked')) {
            jQuery(this).removeAttr('checked');
            var status = 0;
        } else {
            jQuery(this).attr('checked', 'checked');
            var status = 1;
        }
        jQuery.ajax({
            type: 'POST',
            url: 'action.php',
            data: { action: action, task_id: task_id, status: status },
            dataType: 'json',
            success: function (json) {
                return true;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });

        moveTask = (function () {
            jQuery(this).closest("li").toggleClass('done');
            jQuery(this).closest("li").remove();

            taskCount.text(parseInt(taskCount.text()) - 1);

            doneHTML += '<li class=\"done\">';
            doneHTML += '<div class="form-check">';
            doneHTML += jQuery(this)[0].nextSibling.nodeValue;
            doneHTML += '</div>';
            doneHTML += '</li>';

            doneList.append(doneHTML);
        }).bind(this);

        setTimeout(moveTask, 300);

    });
});	
