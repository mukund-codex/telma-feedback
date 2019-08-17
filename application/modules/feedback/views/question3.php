<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Feedback faces</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
    <script>
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script>
</head>

<body>
    <style>
        p.top-text {
            font-size: 35px;
            margin-top: 5em;
        }
        
        .emoji-list li {
            padding: 0 18px;
            min-height: 200px;
        }
        
        .emoji-text {
            font-size: 35px;
            font-weight: 700;
            font-family: sans-serif;
        }
        
        .btn.btn-success {
            padding: 10px 27px;
            font-size: 25px;
        }
        
        p.letter {
            font-size: 75px;
            display: inline;
            padding: 40px 75px;
            font-weight: 900;
            transition: 0.1s;
            transition-timing-function: ease-in-out;
        }
        
        p.letter:hover {
            background: #e5e5e5;
        }
        
        p.letter.selected {
            background: #e5e5e5;
            border: 1px solid black;
        }
    </style>
    <!-- partial:index.partial.html -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <p class="top-text">Would you like to have full text of the daily alerts?</p>
            </div>
            <div class="col-md-6 text-center mt-5">
                <p class="letter">Y</p>
            </div>
            <div class="col-md-6 text-center mt-5">
                <p class="letter">N</p>
            </div>
            <?php $attrubiutes = array('id' => 'addForm');
                echo form_open('feedback/save', $attrubiutes); ?>
                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $doctor_id; ?>" >
                    <input type="hidden" name="answer" id="answer" value="" />
                    <input type="hidden" name="question" id="question" value="question3" >
                <?php echo form_close(); ?>
            <div class="col-md-12 text-center mt-5" id="next" style="display:none;">
                <button class="btn btn-success" name="next" id="next-button" onclick="next();">Submit</button>
                <!-- <a href="<?php echo base_url('feedback/thank_you/') ?>" class="btn btn-success"> Submit </a> -->
            </div>
        </div>
    </div>
    <!-- partial -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>

    <script>
        (function($) {
            $('p.letter').on('click', function() {
                $('p.letter').removeClass('selected');
                $(this).addClass('selected');
                var rate = $(this).text();
                console.log(rate);
                $("#answer").val(rate);
                $("#next").show();
            });
        })(jQuery)

        function next(){
            var answer = $("#answer").val;
            if(answer == ''){
                location.reload();
            }
            var url = $('#addForm').attr('action');
            console.log(url);
            $.ajax({
                type: "POST",
                url: url, 
                data: $('#addForm').serialize(),
                dataType: "json",  
                cache:false,
                success: function (response) {
                    if (response.status) {
					window.location.href = (response.redirectTo) ? response.redirectTo : '';
				    }
                }
            });
        }
        
    </script>

</body>

</html>