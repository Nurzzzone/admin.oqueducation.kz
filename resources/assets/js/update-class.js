((window, undefined) => {
  'use strict';

  $(document).ready(() => {
    // questions
    setQuestionsIdentifier();
    setQuestionsName();
    readQuestionUrl();
    removeQuestionImage();

    // answers
    setAnswersIdentifier();
    setAnswersName();
    readAnswerUrl();
    removeAnswerImage();

    // tasks
    setTasksIdentifier();
    setTasksName();
    readTasksUrl();
    setHintsIdentifiers();
    setRemoveTaskImage();

    // question observer
    let questionObserver = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        setQuestionsIdentifier();
        setQuestionsName();
        readQuestionUrl();

        callAnswersObserver();
      });
    });

    questionObserver.observe($('div[data-repeater-list="questions"]')[0], {
      childList: true,
    });

    // answer observer
    let answerObserver = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
          setAnswersIdentifier();
          setAnswersName();
          readAnswerUrl();
      });
    });

    callAnswersObserver();

    // task observer
    let taskObserver = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        setTasksName();
        setTasksIdentifier();
        readTasksUrl();
        setHintsIdentifiers();
      });    
    });

    taskObserver.observe($('div[data-repeater-list="tasks"]')[0], {
      childList: true, 
    });

    // questions
    function setQuestionsName() {
      let questions = $('div[data-tag="old-question"]');

      $(questions).each((i, e) => {
        // find inputs
        let questionInput = $(e).find(('input[data-tag="questionInput"]')),
            questionIdInput = $(e).find('input[data-tag="questionId"]'),
            questionImageInput = $(e).find('input[data-tag="questionImageInput"]');

        // set question names
        $(questionInput).attr('name', `questions[${i}][name]`);
        $(questionIdInput).attr('name', `questions[${i}][id]`);
        $(questionImageInput).attr('name', `questions[${i}][image]`);
  
        // set answers names
        setAnswersName();
      });
    }

    function setQuestionsIdentifier() {
      let questions = $('div[data-tag="old-question"]');

      questions.each((i, e) => {
        let questionInput = $(e).find('#question_0'),
            questionLabel = $(e).find('label[for="question_0"]'),
            imgInput =  $(e).find('.questionImageUpload'),
            imgLabels = $(e).find('label[for="image"]');
        
        // set name id
        $(questionInput).attr('id', `question_${i}`);
        $(questionLabel).attr('for', `question_${i}`);

        // set image id 
        $(imgInput).attr('id', i + 'questionImage');
        $(imgLabels).each(function(k, l) {
          $(l).attr('for', i + 'questionImage');
        });
      });
      
      let answers = $('fieldset[data-tag="question-fieldset"]').find('.answer');
      answers.each((index, element) => {
        if ($('fieldset[data-tag="question-fieldset"]').find(`#is_correct_${index}`).length) {
          ++index;
        }
        let checkboxInput = $(element).find('input[id="is_correct"]'),
            checkboxLabel = $(element).find('label[for="is_correct"]'),
            imgInput =  $(element).find('.answerImageUpload'),
            imgLabels = $(element).find('label[for="answer-image"]');
        
        $(checkboxInput).attr('id', `is_correct_${index}`);
        $(checkboxLabel).attr('for', `is_correct_${index}`);
        $(imgInput).attr('id', index + 'answerImage');
        
        $(imgLabels).each(function(i, e) {
          $(e).attr('for', index + 'answerImage');
        });
      });
    }

    function callAnswersObserver() {
      let answers = $('div[data-repeater-list="answers"]');
      answers.each((index, element) => {
        answerObserver.observe(element, {
            childList: true, 
        });
      });
    }

    // set answers name
    function setAnswersName() {
      let questions = $('div[data-tag="old-question"]');

      questions.each((index, question) => {
        let answerInputs = $(question).find('input[data-tag="answerInput"]'),
            answerIdInput = $(question).find('input[data-tag="answerId"]'),
            answerImageInputs = $(question).find('input[data-tag="answerImageInput"]'),
            answerCheckbox = $(question).find('input[data-tag="answerCheckbox"]');

        answerInputs.each((i, e) => {
          $(e).attr('name', `questions[${index}][answers][${i}][name]`);
        });

        answerIdInput.each((i, e) => {
          $(e).attr('name', `questions[${index}][answers][${i}][id]`);
        });

        // set answer image names
        answerImageInputs.each((i, e) => {
          $(e).attr('name', `questions[${index}][answers][${i}][image]`);
        });

        // set answer checkbox names
        answerCheckbox.each((i, e) => {
          $(e).attr('name', `questions[${index}][answers][${i}][is_correct][]`);
        });
      });
    }

    function setAnswersIdentifier() {
      let answers = $('fieldset[data-tag="question-fieldset"]').find('.answer');

      answers.each((index, element) => {
        let checkboxInput = $(element).find('input[type="checkbox"]');
        let checkboxLabel = $(element).find('label[data-tag="checkboxLabel"]');
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

    // tasks
    function setTasksName() {
      let tasks = $('div[data-tag="task"]');

      tasks.each((i, e) => {
        // find tasks inputs
        let taskInput = $(e).find('input[data-tag="taskInput"]');
        let taskIdInput = $(e).find('input[type="hidden"]');
        let taskImageInput = $(e).find('input[data-tag="taskImageInput"]');
        let taskHintInput = $(e).find('input[data-tag="taskHintInput"]');

        // set tasks names
        $(taskInput).attr('name', `tasks[${i}][name]`);
        $(taskIdInput).attr('name', `tasks[${i}][id]`);
        $(taskImageInput).attr('name', `tasks[${i}][image]`);
        $(taskHintInput).attr('name', `tasks[${i}][hint]`);
      });
    }

    function setTasksIdentifier() {
      let tasks = $('div[data-tag="task"]');

      tasks.each((i, e) => {
        let imgInput =  $(e).find('.taskImageUpload');
        let imgLabels = $(e).find('label[for="task-image"]');
        let taskLabel = $(e).find('label[for=task_0]');
        let taskInput = $(e).find('input[data-id="taskName"]');

            $(taskLabel).attr('for', `task_${i}`);
            $(taskInput).attr('id', `task_${i}`);
            $(imgInput).attr('id', i + 'taskImage');
            $(imgLabels).each(function(k, l) {
                $(l).attr('for', i + 'taskImage');
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
                                              <button data-tag="removeQuestionImage" type='button' class="btn m-0 remove-question"><i class="bx bx-x align-middle text-danger"></i></button>
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
                                                <button data-tag='answerImageInput' type='button' class="btn m-0 remove-answer"><i class="bx bx-x align-middle text-danger"></i></button>
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
                                                <button data-tag="removeTaskImage" type='button' class="btn m-0 remove-task"><i class="bx bx-x align-middle text-danger"></i></button>
                                                </div>`;
                        $(imageContainer).prependTo(parentContainer);
                    }

                    let imgPreview = $(element).find('.taskImage-preview');
                    reader.onload = function(e) {

                        $(imgPreview).css('background-image', 'url('+ e.target.result +')');
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

    function setHintsIdentifiers() {
      let buttons = $('button[data-tag="hintButton"]');
      let textareas = $('div[data-tag="hintContainer"]');

      textareas.each((i, e) => {
        $(e).attr('id', `hint_container_${i}`);
      });

      buttons.each((i, e) => {
        $(e).attr('id', `hint_button_${i}`);
      });

      buttons.each((i) => {
        $(`#hint_button_${i}`).off();
        $(`#hint_button_${i}`).on('click', (e) => {
          $(`#hint_container_${i}`).toggle();
        })
      });
    }

    function setRemoveTaskImage() {
      $('.task').each((index, element) => {
        if ($(element).find('button[data-tag="removeTaskImage"]').length) {
          let removeButton = $(element).find('button[data-tag="removeTaskImage"]');
          let taskImageContainer = $(element).find('.taskImage-preview');
          let taskImageInput = $(element).find('.taskImageUpload');

          $(removeButton).on('click', () => {
            $(taskImageInput).val('');
            $(taskImageContainer).remove();
          });
        }
      });
    }

    function removeQuestionImage() {
      $('.question').each((index, element) => {
        if ($(element).find('button[data-tag="removeQuestionImage"]').length) {
          let removeButton = $(element).find('button[data-tag="removeQuestionImage"]');
          let taskImageContainer = $(element).find('.quesitonImage-preview');
          let taskImageInput = $(element).find('.questionImageUpload');

          $(removeButton).on('click', () => {
            $(taskImageInput).val('');
            $(taskImageContainer).remove();
          });
        }
      });
    }

    function removeAnswerImage() {
      $('.answer').each((index, element) => {
        if ($(element).find('button[data-tag="answerQuestionImage"]').length) {
          let removeButton = $(element).find('button[data-tag="answerQuestionImage"]');
          let taskImageContainer = $(element).find('.answerImage-preview');
          let taskImageInput = $(element).find('.answerImageUpload');

          $(removeButton).on('click', () => {
            $(taskImageInput).val('');
            $(taskImageContainer).remove();
          });
        }
      });
    }
  });
})(window);