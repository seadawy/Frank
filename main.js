let i = 0;
let OptionNum = 3;
let Questions = [];
let Options = [];
let Answer = [];

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

function AddQuestion() {
    var option = [];
    $('.optionInput').each(function (index, element) {
        option.push($(element).val());
    });
    Answer.push($('input[name="answerCheck"]:checked').val());
    Questions.push($('.questionInput').val());
    Options.push(option);
    i++;
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
    if (pointer > 0) {
        $('#prev').prop('disabled', false);
    } else {
        $('#prev').prop('disabled', true);
    }

    if (pointer == Questions.length) {
        $('#next').prop('value', 'إضافة سؤال');
    } else {
        $('#next').prop('value', 'التالى');
    }

    $('.finish').prop('value', " إرسال " + Questions.length + " سؤال ")
}

$('#next').click(function () {
    if (i < Questions.length) {
        var option = [];
        $('.optionInput').each(function (index, element) {
            option.push($(element).val());
        });
        if (validateForm()) {
            Answer[i] = $('input[name="answerCheck"]:checked').val();
            Questions[i] = $('.questionInput').val();
            Options[i] = option;
        }
        i++;
        LoadIndex(i);
    } else {
        if (validateForm()) {
            AddQuestion();
            LoadIndex(i);
            CleanUp();
        }
    }
});

$('#prev').click(function () {
    if (i > 0) {
        i--;
        LoadIndex(i);
    }
});

LoadIndex(i);

$('form').submit(function (e) {
    e.preventDefault();
})
/* 
$(document).ready(function () {
    $.ajax({
        url: 'controller.php',
        method: 'POST',
        data: {
            action: "",
        },
        success: function (response) {
            console.log(response);
            Load();
        },
        error: function (error) {
            console.log(error);
        }
    });
}); */