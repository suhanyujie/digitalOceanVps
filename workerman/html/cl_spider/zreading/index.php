<html>
<title>版块发帖数量前20名</title>
<meta charset="utf-8"/>
<head>
    <script src="../library/d3/d3.min.js"></script>
    <style>

        .bar {
            fill: steelblue;
        }

        .bar:hover {
            fill: brown;
        }

        .axis {
            font: 10px sans-serif;
        }

        .axis path,
        .axis line {
            fill: none;
            stroke: #000;
            shape-rendering: crispEdges;
        }

        .x.axis path {
            display: none;
        }

    </style>
<body>
<h1>版块发帖数量前20名</h1>

<?php
include './config.php';

try {
    $stmt = $pdo->query("select *, count(*) from thread group by author order by count(*) desc");
    $authors = $stmt->fetchAll();
} catch (PDOException $error) {
    alert($error->getMessage());
}
//var_dump($authors);
// 数据写入data.tsv文件供d3.js读取
$handle = fopen("./data.csv", "w");
//写标题
fwrite($handle, "author,counter\n");
//写内容
foreach ($authors as $value) {
    if ($value['author'] !== '' && $value['count(*)'] > 140)
        fwrite($handle, $value['author'] . "," . $value['count(*)'] . "\n");
}
fclose($handle);
unset($stmt);
?>

<script>

    var margin = {top: 20, right: 20, bottom: 30, left: 40},
        width = 1200 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    var x = d3.scale.ordinal()
        .rangeRoundBands([0, width], .1);

    var y = d3.scale.linear()
        .range([height, 0]);

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left")

    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    d3.csv("data.csv", type, function (error, data) {
        if (error) throw error;

        x.domain(data.map(function (d) {
            return d.author;
        }));
        y.domain([0, d3.max(data, function (d) {
            return d.counter;
        })]);

        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")

        svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function (d) {
                return x(d.author);
            })
            .attr("width", x.rangeBand())
            .attr("y", function (d) {
                return y(d.counter);
            })
            .attr("height", function (d) {
                return height - y(d.counter);
            });
    });

    function type(d) {
        d.counter = +d.counter;
        return d;
    }

</script>


<h1>帖子回复数量前20名</h1>
<p>由于标题大部分词语不雅，请自行点击下面的链接去站内浏览</p>
<?php

try {
    $stmt = $pdo->query("select * from thread order by comments desc");
    $comments = $stmt->fetchAll();
} catch (PDOException $error) {
    alert($error->getMessage());
}

for ($i = 0; $i < 20; $i++){
    echo $i . ". ***************************************************[<a href=\"{$comments[$i]['url']}\">跳转链接</a>]<br>";
}

?>

</body>
</html>

