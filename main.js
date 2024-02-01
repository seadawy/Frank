let i = 0;
let OptionNum = 3;
let Questions = [];
let Options = [];
let Answer = [];

/* OVERFLOW SHIT */
String.prototype.toArabic = function () {
    var id = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    return this.replace(/[0-9]/g, function (w) {
        return id[+w];
    });
};
/* CHECK VALIDATION */
function validateForm() {
    var questionInput = $(".questionInput").val().trim();
    if (questionInput === "") {
        return false;
    }

    var optionsFilled = false;
    $(".optionInput").each(function () {
        if ($(this).val().trim() !== "") {
            optionsFilled = true;
        } else {
            optionsFilled = false;
        }
    });
    if (!optionsFilled) {
        return false;
    }

    var radioButtonSelected = $("input[name='answerCheck']:checked").length > 0;
    if (!radioButtonSelected) {
        return false;
    }

    return true;
}
/* SAVE QUESTION */
function SaveCurrentQuestion() {
    var option = [];
    $('.optionInput').each(function (index, element) {
        option.push($(element).val());
    });
    Answer[i] = $('input[name="answerCheck"]:checked').val();
    Questions[i] = $('.questionInput').val();
    Options[i] = option;
}
/* OPTION CONTROLES */
function AddOption() {
    var newOption = $('<div>', {
        id: 'Option' + OptionNum,
        class: 'form-check optionGroup additional',
        html: `<input class="form-check-input" type="radio" value="${OptionNum}" name="answerCheck" required>
                <input type="text" class="optionInput" placeholder="ادخل إختيار" required>
                <input type="button" onclick="DelOption(this)" class="btn cancel" value="X">`
    });
    $("#options").append(newOption);
    OptionNum++;
}
function DelOption(e) {
    e.parentNode.remove();
    OptionNum--;
}
function CleanUp() {
    $('input[type="text"]').val('');
    $('input[type="radio"]').prop('checked', false);
    $('.additional').each(function (index, element) {
        element.remove();
    });
    OptionNum = 3;
}

function LoadIndex(pointer) {
    CleanUp();
    $('.indexed').removeClass('active');
    $('#indexGraid .indexed').each(function (inx, ele) {
        if (inx == pointer) {
            $(ele).addClass('active');
        }
    });
    if (pointer < Questions.length) {
        $('.questionInput').val(Questions[pointer]);
        for (let x = 2; x < Options[pointer].length; x++) {
            AddOption();
        }
        $('.optionInput').each(function (index, element) {
            $(element).val(Options[pointer][index]);
        });
        $('[name="answerCheck"]').each(function (index, element) {
            if (index + 1 == Answer[pointer]) {
                $(element).click();
            };
        });
    }

    /* AVABALILITY OF ARROWS */
    if (pointer > 0) {
        $('#prev').prop('disabled', false);
    } else {
        $('#prev').prop('disabled', true);
    }
    if (pointer == Questions.length) {
        $('#next').prop('disabled', true);
    } else {
        $('#next').prop('disabled', false);
    }

    $('.finishtext').text(" جاهز لإرسال " + (Questions.length + 1).toString().toArabic() + " سؤال ")
}

$('#AddQuestion').click(function () {
    if (validateForm()) {
        SaveCurrentQuestion();
        i++;
        var newbutton = $('<input>', { type: "button", class: "btn indexed", numeric: i, value: (i + 1).toString().toArabic() })
        $('#AddQuestion').before(newbutton);
        LoadIndex(i);
    } else {
        $("#alert").fadeIn();
        setTimeout(function () {
            $("#alert").fadeOut();
        }, 2500);
    }
});

$('form').submit(function (e) {
    e.preventDefault();
});


$('#next').click(function () {
    if (validateForm()) {
        if (i < Questions.length) {
            i++;
            LoadIndex(i);
        }
    } else {
        $("#alert").fadeIn();
        setTimeout(function () {
            $("#alert").fadeOut();
        }, 2500);
    }
});

$('#prev').click(function () {
    if (validateForm()) {
        if (i > 0) {
            i--;
            LoadIndex(i);
        }
    } else {
        $("#alert").fadeIn();
        setTimeout(function () {
            $("#alert").fadeOut();
        }, 2500);
    }
});
$('.finish').click(function () {
    if (validateForm()) {
        $('.finishScreen').show();
        SaveCurrentQuestion();
    } else {
        $("#alert").fadeIn();
        setTimeout(function () {
            $("#alert").fadeOut();
        }, 2500);
    }
});
$('#cancelScreen').click(function () {
    $('.finishScreen').fadeOut();
});
$('.finishScreen').hide();
$('#realfinish').click(function () {
    $.ajax({
        url: 'controller.php',
        method: 'POST',
        data: {
            Action: "AddQuiz",
            Questions: Questions,
            Options: Options,
            Answers: Answer,
        },
        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.log(error);
        }
    });
});
$(document).on('click', '.indexed', function () {
    if (validateForm()) {
        i = $(this).attr("numeric");
        LoadIndex(i);
    } else {
        $("#alert").fadeIn();
        setTimeout(function () {
            $("#alert").fadeOut();
        }, 2500);
    }
});
$(document).ready(function () {
    LoadIndex(i);
    $("#alert").fadeOut();
});
