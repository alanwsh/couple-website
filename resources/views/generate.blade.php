<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    

<input type="text" name="" id="generate" placeholder = "100000">
<button onclick = "start();" id = "stopwatch">Generate</button>
<output id="display-area">00:00:00.000</output>
<script>
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var timeBegan = null
            , timeStopped = null
            , stoppedDuration = 0
            , started = null;

            function start() {
                if (timeBegan === null) {
                    timeBegan = new Date();
                }

                if (timeStopped !== null) {
                    stoppedDuration += (new Date() - timeStopped);
                }
                started = setInterval(clockRunning, 10);	
            }

            function stop() {
                timeStopped = new Date();
                clearInterval(started);
            }
            
            function reset() {
                clearInterval(started);
                stoppedDuration = 0;
                timeBegan = null;
                timeStopped = null;
                document.getElementById("display-area").innerHTML = "00:00:00.000";
            }

            function clockRunning(){
                var currentTime = new Date()
                    , timeElapsed = new Date(currentTime - timeBegan - stoppedDuration)
                    , hour = timeElapsed.getUTCHours()
                    , min = timeElapsed.getUTCMinutes()
                    , sec = timeElapsed.getUTCSeconds()
                    , ms = timeElapsed.getUTCMilliseconds();

                document.getElementById("display-area").innerHTML = 
                    (hour > 9 ? hour : "0" + hour) + ":" + 
                    (min > 9 ? min : "0" + min) + ":" + 
                    (sec > 9 ? sec : "0" + sec) + "." + 
                    (ms > 99 ? ms : ms > 9 ? "0" + ms : "00" + ms);
            };
    $('#stopwatch').click(function(){
       var number = $('#generate').val();
       $.ajax({
            url:'trie/generate',
            data: {number:number},
            method: 'post',
            success:function(response){
               stop();
            }
       });
    });
   
</script>
</body>