var dataSet = {
    value : 150470,
    children : [
        {value : 63101, name : "Profit"},
        {value : 61320, name : "Loss"},
        {value : 7438, name : "tax"},
        {value : 18611, name : "Commission"}
    ]
}


var color = d3.scale.category10();

var bubble = d3.layout.pack()
    .size([320, 320])

var pack = d3.select("#myGraph")
    .selectAll("g")
    .data(bubble.nodes(dataSet))
    .enter()
    .append("g")
    .attr("transform", function(d,i){
        return "translate("+ d.x + "," + d.y + ")";
    })

pack.append("circle")
    .attr("r", 0)
    .transition()
    .duration(function(d,i){
        return d.depth * 1000 + 500;
    })
    .attr("r", function(d,i){
        return d.r;
    })
    .style("stroke", function(d,i){
        return color(i);
    })
        .style("stroke-width", "2px")


pack.append("text")
    .style("opacity", 0)
    .transition()
    .duration(3000)
    .style("opacity", 1.0)
    .text(function(d,i){
        if(d.depth == 1){
            return d.name;
        }
        return null;
    })