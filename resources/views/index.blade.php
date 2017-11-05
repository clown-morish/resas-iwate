<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>U-turn Iwate!</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/app.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="./js/app.js"></script>
    <!--script src="https://d3js.org/d3.v4.min.js"></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
    <script src="./js/render_chart.js"></script>

    <!-- Styles -->
</head>
<body>
    <header>
        <h1>U-turn Iwate!</h1>
        <p class="subTitle">全ての岩手へUターンを考えている人, 岩手に住んでいる学生のための情報サイト</p>
    </header>

    <main>
        <p class="read">〜 岩手と東京を客観的なデータで比較. 岩手の魅力を再発見! 〜</p>

        <article>
            <h2>数値から見た岩手のいいところ</h2>
            <div class="select-forms">
                <select name="iwateCity" id="iwate-city" class="form-control">
                    @foreach ($iwate as $city)
                        <option value="{{$city['cityCode']}}">{{ $city["cityName"]  }}</option>
                    @endforeach
                </select>
                と
                <select name="tokyoCity" id="tokyo-city" class="form-control">
                    @foreach ($tokyo as $city)
                        <option value="{{$city['cityCode']}}">{{ $city["cityName"]  }}</option>
                    @endforeach
                </select> の比較
            </div>

            <section>
                <h3>1. 豊かな自然!</h3>
                <div class="chartWrap">
                    <canvas id="natureChart" width="400" height="400"></canvas>
                </div>
                <p>日本百名山に選定されている岩手山, 観光地としても有名な小岩井農場など岩手には自然がたくさんあります</p>
            </section>

            <section>
                <h3>2. 昼夜間人口比率</h3>
                <div class="chartWrap">
                    <canvas id="populationChart"></canvas>
                </div>
            </section>
        </article>

        <article>
            <h2>Uターンしてみたいけど, 実際どうなの?</h2>
            <section>
                <h3>仕事の話</h3>
                <h4>求人</h4>

                <h3>お金の話</h3>
                <h4>一人あたりの賃金</h4>
                <div class="chartWrap">
                    <canvas id="incomeChart" width="400" height="400"></canvas>
                </div>
            </section>
        </article>
    </main>
</body>
</html>
