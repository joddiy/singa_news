function filterNodesById(nodes, id) {
    return nodes.filter(function (n) {
        return n.id === id;
    });
}

function filterNodesByType(nodes, value) {
    return nodes.filter(function (n) {
        return n.type === value;
    });
}

function triplesToGraph(triples) {

    svg.html("");
    //Graph
    var graph = {nodes: [], links: [], triples: []};

    //Initial Graph from triples
    triples.forEach(function (triple) {
        var subjId = triple.subject;
        var predId = triple.predicate;
        var objId = triple.object;

        var subjNode = filterNodesById(graph.nodes, subjId)[0];
        var objNode = filterNodesById(graph.nodes, objId)[0];

        if (subjNode == null) {
            subjNode = {id: subjId, label: subjId, weight: 1, type: "node"};
            graph.nodes.push(subjNode);
        }

        if (objNode == null) {
            objNode = {id: objId, label: objId, weight: 1, type: "node"};
            graph.nodes.push(objNode);
        }

        var predNode = {id: predId, label: predId, weight: 1, type: "pred"};
        graph.nodes.push(predNode);

        var blankLabel = "";

        graph.links.push({source: subjNode, target: predNode, predicate: blankLabel, weight: 1});
        graph.links.push({source: predNode, target: objNode, predicate: blankLabel, weight: 1});

        graph.triples.push({s: subjNode, p: predNode, o: objNode});

    });

    return graph;
}


function update() {
    // ==================== Add Marker ====================
    svg.append("svg:defs").selectAll("marker")
        .data(["end"])
        .enter().append("svg:marker")
        .attr("id", String)
        .attr("viewBox", "0 -5 10 10")
        .attr("refX", 30)
        .attr("refY", -0.5)
        .attr("markerWidth", 6)
        .attr("markerHeight", 6)
        .attr("orient", "auto")
        .append("svg:polyline")
        .attr("points", "0,-5 10,0 0,5");

    // ==================== Add Drag function ====================
    var drag = force.drag().on("dragstart", dragstart);

    // ==================== Add Links ====================
    var links = svg.selectAll(".link")
        .data(graph.triples)
        .enter()
        .append("path")
        .attr("marker-end", "url(#end)")
        .attr("class", "link");

    // ==================== Add Link Names =====================
    var linkTexts = svg.selectAll(".link-text")
        .data(graph.triples)
        .enter()
        .append("text")
        .attr("class", "link-text")
        .text(function (d) {
            return d.p.label;
        });

    // ==================== Add Link Names =====================
    var nodeTexts = svg.selectAll(".node-text")
        .data(filterNodesByType(graph.nodes, "node"))
        .enter()
        .append("text")
        .attr("class", "node-text")
        .text(function (d) {
            return d.label;
        });

    // ==================== Add Node =====================
    var nodes = svg.selectAll(".node")
        .data(filterNodesByType(graph.nodes, "node"))
        .enter()
        .append("circle")
        .attr("class", "node")
        .attr("r", 8)
        .on("dblclick", dblclick)
        .call(drag);

    // ==================== Force ====================
    force.on("tick", function () {
        nodes
            .attr("cx", function (d) {
                return d.x;
            })
            .attr("cy", function (d) {
                return d.y;
            });

        links
            .attr("d", function (d) {
                return "M" + d.s.x + "," + d.s.y
                    + "S" + d.p.x + "," + d.p.y
                    + " " + d.o.x + "," + d.o.y;
            });

        nodeTexts
            .attr("x", function (d) {
                return d.x + 12;
            })
            .attr("y", function (d) {
                return d.y + 3;
            });


        linkTexts
            .attr("x", function (d) {
                return 4 + (d.s.x + d.p.x + d.o.x) / 3;
            })
            .attr("y", function (d) {
                return 4 + (d.s.y + d.p.y + d.o.y) / 3;
            });
    });

    function dblclick(d) {
        let t_name = $('#t_name').val();
        let day = $('#day').val();
        window.location = "/site/result?c_name=" + d.label + "&t_name=" + t_name + "&day=" + day;
        // window.location.replace();
        // d3.select(this).classed("fixed", d.fixed = false);
    }

    function dragstart(d) {
        d3.select(this).classed("fixed", d.fixed = true);
        centerId = d.id;
    }

    // ==================== Run ====================
    force
        .nodes(graph.nodes)
        .links(graph.links)
        .charge(-500)
        .linkDistance(50)
        .start()
    ;
}


var triples;
var svg = d3.select("#svg-body").append("svg:svg")
    .attr("width", "100%")
    .attr("height", "100%");
var force;
var graph;


function redraw() {
    console.log("here", d3.event.translate, d3.event.scale);
    svg.attr("transform",
        "translate(" + d3.event.translate + ")"
        + " scale(" + d3.event.scale + ")");
}

function refresh_graph() {
    $.ajax({
        type: 'GET',
        url: '/api/get-graph',
        data: {
            c_name: $('#c_name').val(),
            keyword: $('#rel').val(),
        },
        success: function (data) {
            if (data['code'] === 200) {

                triples = data['data'];

                force = d3.layout.force().size([350, 566]);

                graph = triplesToGraph(triples);

                update();

            }
        }
    });
}

refresh_graph();

$("a#refresh").bind('click', function () {
    refresh_graph();
});