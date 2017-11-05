<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>U-turn Iwate!</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/app.js"></script>
        <!--script src="https://d3js.org/d3.v4.min.js"></script-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>

        <!-- Styles -->
    </head>
    <body>
        <header>
            <h1>U-turn Iwate!</h1>
            <p>全ての岩手へUターンを考えている人, 岩手に住んでいる学生のための情報サイト</p>
        </header>

        <main>
            <article>
                <h2>数字から見た岩手のいいところ</h2>

                <section>
                    <h3>1. 豊かな自然!</h3>
                    <p>日本百名山に選定されている岩手山, 観光地としても有名な小岩井農場など岩手には自然がたくさんあります</p>
                    <canvas id="natureChart" width="400" height="400"></canvas>


                </section>

                <section>
                    <h3>2. 土地が安い!</h3>
                </section>
            </article>

            <article>
                <h2>Uターンしてみたいけど, 実際どうなの?</h2>
                <section>
                    <h3>仕事の話</h3>
                    
                    <h3>お金の話</h3>
                </section>
            </article>
        </main>
    </body>
</html>
