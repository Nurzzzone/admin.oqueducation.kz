(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

    $(document).ready(() => {
        readQuestionUrl();
        readAnswerUrl();
        readTasksUrl();
    
        let questionObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                setQuestionsIdentifier();
                readQuestionUrl();

                $('div[data-repeater-list="answers"]').each(function(index, element) {
                    console.log(element);
                    answerObserver.observe(element, {
                        childList: true, 
                    });
                });
            });    
        });
    
        questionObserver.observe($('div[data-repeater-list="questions"]')[0], {
            childList: true, 
        });
    
        let answerObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                setAnswersIdentifier();
                readAnswerUrl();
            });    
        });
    
        answerObserver.observe($('div[data-repeater-list="answers"]')[0], {
            childList: true, 
        });
    
        let taskObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                setTasksIdentifier();
                readTasksUrl();
            });    
        });
    
        taskObserver.observe($('div[data-repeater-list="tasks"]')[0], {
            childList: true, 
        });
    
        function setQuestionsIdentifier() {
            $('.question').each((index, element) => {
                let questionInput = $(element).find('#question_0'),
                    questionLabel = $(element).find('label[for="question_0"]'),
                    imgInput =  $(element).find('.questionImageUpload'),
                    imgLabels = $(element).find('label[for="image"]');
                
                    $(questionInput).attr('id', `question_${index}`);
                    $(questionLabel).attr('for', `question_${index}`);
                    $(imgInput).attr('id', index + 'questionImage');
                    $(imgLabels).each(function(i, e) {
                        $(e).attr('for', index + 'questionImage');
                    });
            });
            
            let answers = $('#questions').find('.answer');
            answers.each((index, element) => {
                if ($('#questions').find(`#is_correct_${index}`).length) {
                    ++index;
                }
                let checkboxInput = $(element).find('input[id="is_correct"]');
                let checkboxLabel = $(element).find('label[for="is_correct"]');
                let imgInput =  $(element).find('.answerImageUpload');
                let imgLabels = $(element).find('label[for="answer-image"]');
                
                    $(checkboxInput).attr('id', `is_correct_${index}`);
                    $(checkboxLabel).attr('for', `is_correct_${index}`);
                    $(imgInput).attr('id', index + 'answerImage');
                    $(imgLabels).each(function(i, e) {
                        $(e).attr('for', index + 'answerImage');
                    });
            });
        }
    
        function setAnswersIdentifier() {
            $('.answer').each((index, element) => {
                if ($('#questions').find(`#is_correct_${index}`).length) {
                    ++index;
                }
                let checkboxInput = $(element).find('input[id="is_correct"]');
                let checkboxLabel = $(element).find('label[for="is_correct"]');
                let imgInput =  $(element).find('.answerImageUpload');
                let imgLabels = $(element).find('label[for="answer-image"]');
                
                    $(checkboxInput).attr('id', `is_correct_${index}`);
                    $(checkboxLabel).attr('for', `is_correct_${index}`);
                    $(imgInput).attr('id', index + 'answerImage');
                    $(imgLabels).each(function(i, e) {
                        $(e).attr('for', index + 'answerImage');
                    });
            });
        }
    
        function setTasksIdentifier() {
            $('.task').each((index, element) => {
                let imgInput =  $(element).find('.taskImageUpload');
                let imgLabels = $(element).find('label[for="task-image"]');
                let taskLabel = $(element).find('label');
                let taskInput = $(element).find('input');
                let button = $(element).find('#hint-button');
                let hintBox = $(element).find('#hint-popover');

                    $(button).attr('id', `hintButton_${index}`);
                    $(hintBox).attr('id', `hintBox_${index}`);
                    setHintsIdentifiers(index);

                    $(taskLabel).attr('for', `task_${index}`);
                    $(taskInput).attr('id', `task_${index}`);
                    $(imgInput).attr('id', index + 'taskImage');
                    $(imgLabels).each(function(i, e) {
                        $(e).attr('for', index + 'taskImage');
                    });
            });
        }
    
        function readQuestionUrl() {
            $('.question').each((index, element) => {
                let imgInput =  $(element).find('.questionImageUpload');
            
                    $(imgInput).change(function() {
                        if (this.files && this.files[0]) {
                            let reader = new FileReader();
                            let parentContainer = $(element).find('div[class="border mb-1 pb-2"]');
                            if (!$(element).find('.quesitonImage-preview').length) {
                                let imageContainer = `<div style='background-image: url();' class='quesitonImage-preview users-avatar-shadow' width="240" height="240">
                                                    <button type='button' class="btn m-0 remove-question"><i class="bx bx-x align-middle text-danger"></i></button>
                                                    </div>`;
                                $(imageContainer).prependTo(parentContainer);
                            }
            
                            let imgPreview = $(element).find('.quesitonImage-preview');
                            reader.onload = function(e) {
            
                                $(imgPreview).css('background-image', 'url('+e.target.result +')');
                                $(imgPreview).find('.quesitonImage-preview').hide();
                                $(imgPreview).find('.quesitonImage-preview').fadeIn(650);
                            }
                            reader.readAsDataURL(this.files[0]);
            
                            $(element).find('.remove-question').on('click', function(e) {
                                e.preventDefault();
                                $(parentContainer).find('input[type="file"]').val('');
                                $(imgPreview).fadeOut(650);
                                $(imgPreview).css('background-image', 'url()');
                                $(imgPreview).remove();
                            })
                        }
                    })
                });
        }
    
        function readAnswerUrl() {
            $('.answer').each((index, element) => {
                let imgInput =  $(element).find('.answerImageUpload');

                $(imgInput).change(function() {
                    if (this.files && this.files[0]) {
                        let reader = new FileReader();
                        let parentContainer = $(element).find('div[class="row justify-content-between align-items-start"]');
                        if (!$(element).find('.answerImage-preview').length) {
                            let imageContainer = `<div style='background-image: url();' class='answerImage-preview users-avatar-shadow' width="240" height="240">
                                                    <button type='button' class="btn m-0 remove-answer"><i class="bx bx-x align-middle text-danger"></i></button>
                                                    </div>`;
                            $(imageContainer).prependTo(parentContainer);
                        }

                        let imgPreview = $(element).find('.answerImage-preview');
                        reader.onload = function(e) {

                            $(imgPreview).css('background-image', 'url('+e.target.result +')');
                            $(imgPreview).find('.answerImage-preview').hide();
                            $(imgPreview).find('.answerImage-preview').fadeIn(650);
                        }
                        reader.readAsDataURL(this.files[0]);

                        $(element).find('.remove-answer').on('click', function(e) {
                            e.preventDefault();
                            $(parentContainer).find('input[type="file"]').val('');
                            $(imgPreview).fadeOut(650);
                            $(imgPreview).css('background-image', 'url()');
                            $(imgPreview).remove();
                        })
                    }
                })
            })
        }
    
        function readTasksUrl() {
            $('.task').each((index, element) => {
                let imgInput =  $(element).find('.taskImageUpload');

                $(imgInput).change(function() {
                    if (this.files && this.files[0]) {
                        let reader = new FileReader();
                        let parentContainer = $(element).find('div[class="col-md-11"]');
                        if (!$(element).find('.taskImage-preview').length) {
                            let imageContainer = `<div style='background-image: url();' class='taskImage-preview users-avatar-shadow' width="240" height="240">
                                                    <button type='button' class="btn m-0 remove-task"><i class="bx bx-x align-middle text-danger"></i></button>
                                                    </div>`;
                            $(imageContainer).prependTo(parentContainer);
                        }

                        let imgPreview = $(element).find('.taskImage-preview');
                        reader.onload = function(e) {

                            $(imgPreview).css('background-image', 'url('+e.target.result +')');
                            $(imgPreview).find('.taskImage-preview').hide();
                            $(imgPreview).find('.taskImage-preview').fadeIn(650);
                        }
                        reader.readAsDataURL(this.files[0]);

                        $(element).find('.remove-task').on('click', function(e) {
                            e.preventDefault();
                            $(parentContainer).find('input[type="file"]').val('');
                            $(imgPreview).fadeOut(650);
                            $(imgPreview).css('background-image', 'url()');
                            $(imgPreview).remove();
                        });
                    }
                })
            })
        }
        
        function setHintsIdentifiers(index) {
            $(`#hintButton_${index}`).off()
            $(`#hintButton_${index}`).click((e) => {
                e.preventDefault();
                $(`#hintBox_${index}`).toggle();
            });
        }

        $('#hint-button').on('click', (e) => {
            e.preventDefault();
            $('#hint-popover').toggle();
        });
    
        // let hintObserver = new MutationObserver(function(mutations) {
        //     mutations.forEach(function(mutation) {
        //         handleHintBox();
        //     });    
        // });
    
        // hintObserver.observe($('div[data-repeater-list="tasks"]')[0], {
        //     childList: true, 
        // });
    
        // function handleHintBox() {
        //     $('.hint-box').each(function(index, element) {
        //         let button = $(element).find('.hint-button');
        //         let hintbox = $(element).find('.hint-popover');
        //         $(button).attr('id', index + 'hintButton');
        //         $(hintbox).attr('id', index + 'hintPopover');
        //         $(`#${index}hintButton`).on('click', function() {
        //             $(`#${index}hintPopover`).toggle();
        //         });
        //     });
        // }
    });

})(window);