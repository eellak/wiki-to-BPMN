<!DOCTYPE html>
<html>
<head>
<title>wiki2BPMN</title>
<meta name="viewport" content="width=device-width, initial-scale=1,  user-scalable=yes">
<!--  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <meta charset="UTF-8">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<style>
.w3-tangerine {
    font-family: "Tangerine", serif;
}
</style>
<style>
input { width: 100%; padding: .5em 1em; }
.button {
  padding: 15px 25px;
  font-size: 12px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  width: 100%;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
    width: 0%;
    height: 30px;
    background-color: #4CAF50;
    text-align: center; /* To center it horizontally (if you want) */
    line-height: 30px; /* To center it vertically */
    color: white; 
}

</style>
<style>
div.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
  table-layout: fixed;
  word-wrap: break-word;
}
.divTable.blueTable .divTableCell, .divTable.blueTable .divTableHead {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
.divTable.blueTable .divTableBody .divTableCell {
  font-size: 13px;
}
.divTable.blueTable .divTableRow:nth-child(even) {
  background: #D0E4F5;
}
.divTable.blueTable .divTableHeading {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
.divTable.blueTable .divTableHeading .divTableHead {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
.divTable.blueTable .divTableHeading .divTableHead:first-child {
  border-left: none;
}

.blueTable .tableFootStyle {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
.blueTable .tableFootStyle {
  font-size: 14px;
}
.blueTable .tableFootStyle .links {
	 text-align: right;
}
.blueTable .tableFootStyle .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
.blueTable.outerTableFooter {
  border-top: none;
}
.blueTable.outerTableFooter .tableFootStyle {
  padding: 3px 5px; 
}
/* DivTable.com */
.divTable{ display: table; }
.divTableRow { display: table-row; }
.divTableHeading { display: table-header-group;}
.divTableCell, .divTableHead { display: table-cell;}
.divTableHeading { display: table-header-group;}
.divTableFoot { display: table-footer-group;}
.divTableBody { display: table-row-group;}
</style>


<script src="htmlparser.js"></script>
<script src="html2json.js"></script>

<script src="query.tabletojson.min.js"></script>
<script src="query.tabletojson.js"></script>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

<script src="jquery.tabletojson.min.js"></script>
<script src="jquery.tabletojson.js"></script>

<script src="bpmn-io-dist/bpmn-viewer.js"></script>

<script>
//Basic config parameters
var thisServer = "localhost";
var thisServerplusFolder = "localhost/mw";
var thisServerFolder = "/mw";
// end of basic config parameters
var n1=-1;
var n2=-2; //used to check whether page is CPSV based
var newtemplate_diadikasies = 0;
var CPSVarray = [];
var noCPSVarray = [];
urlsaved="";
messages = "";
BPMNwikipage = "";
processSteps = 0;
autocontinue = 0;
noCPSVpage = "";
ispageCPSVbased = false;
myhost = "";
addBPMNsectioncounter = 0;
dataa = "";
txt22="";
txt1="";
//edittoken = mw.user.tokens.get( 'editToken' );
//edittoken ="aeb6432486b68cfae153e0f5437da22a59cf7eb9"+"%2B%5C&utf8=1";
edittoken ="";
cpsv2HtmlTable="";
//j=1;
bpmnXML="";
bpmnEmbed="";
linktoBPMN = "";
path_bpmn = "";
path_bpmn_href = "";
filenameX = "";

function autocompleteDatalist(){
// Get the <datalist> and <input> elements.
var dataList = document.getElementById('json-datalist');
var input = document.getElementById('ajax');

var obj, dbParam, xmlhttp, jsonOptions, myObj, myObj2 , myObj3, myObj4, x, y, txt = "";

xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
//alert(JSON.stringify(myObj));
       for (x in myObj){
         
         if (x=="query") {
            myObj2  = JSON.stringify(myObj[x]);
            //alert(myObj2+"-"+x);
//for (i in myObj.cars) {
//    x += myObj.cars[i];
//}
myObj3 = JSON.parse(myObj2);
           // alert(myObj3);

            for (y in myObj3.allpages) {
            myObj4 = JSON.stringify(myObj3.allpages[y].title);
        //parse ""
        myObj4  = myObj4.substring(1,myObj4.length-1);
        // Create a new <option> element.
        var option = document.createElement('option');
        // Set the value using the item in the JSON array.
        option.value = myObj4 ;
        // Add the <option> element to the <datalist>.
        dataList.appendChild(option);


          //alert(myObj4+"-"+y);
          }
          }

      // Update the placeholder text.
      input.placeholder = "π.χ. Χορήγηση";
       }




      // Update the placeholder text.
      //input.placeholder = "e.g. datalist";
         //document.getElementById("code").innerHTML = edittoken;

    } else {
      // An error occured :(
      input.placeholder = "Couldn't load datalist options :(";
    }
};
// Update the placeholder text.
input.placeholder = "Loading options...";
xmlhttp.open("POST", thisServerFolder+"/api.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("action=query&format=json&list=allpages&utf8=1&apfrom="+document.getElementById('ajax'));


}

function createBPMN(){
//var i=0;
var tasks = [];
var bpmntasks = [];
var tasksString ="";
var bpmntasksString="";
var sequenceflows = [];
var bpmnsequenceflows = [];
var sequenceflowsString="";
var bpmnsequenceflowsString="";

var bpmnannotationString="";
var bpmnAnnotations = [];
var an = [];
var ann1 = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
var ann2 = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
var ann3 = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
var ann4 = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
var bpmnAnnShapesString ="";
var xann = [];
var yann = [];
var xannm =[];
var yannm =[];

var elements = "";
var bpmnXML="";
var bpmnXML2="";
var bpmnXML3="";
var bpmnShapes =[];
var bpmnShapesString = "";
var bpmnEdges =[];
var bpmnEdgesString = "";

var process=document.getElementById("URLin").innerHTML+"_BPMN";
var countSteps=document.getElementById("countBPMNsteps").innerHTML;
//alert(countSteps+"-"+process);

for (i=1; i <= countSteps; i++) {
tasks[i-1] = process+"-Task-"+i;
tasksString = tasksString + tasks[i-1] + ",";
//alert(tasksString);


}

    for (j=1; j < countSteps; j++) {
        sequenceflows[j-1] = process+"-sequenceflow-"+j;
        sequenceflowsString = sequenceflowsString + sequenceflows[j-1] + ",";
//alert(sequenceflowsString);
    }


for (i=1; i <= countSteps; i++) {

    if (((i)==1) && (countSteps<=1)) {
    bpmntasks[i-1] = "<bpmn:task id='"+tasks[i-1]+"' name='"+tasks[i-1]+"'></bpmn:task>";
    } 
    else if (((i)==1) && (countSteps>1)) {
    bpmntasks[i-1] = "<bpmn:task id='"+tasks[i-1]+"' name='"+tasks[i-1]+"'><bpmn:outgoing>"+sequenceflows[i-1]+"</bpmn:outgoing></bpmn:task>";
    } else if ((i)==countSteps) {
    bpmntasks[i-1] = "<bpmn:task id='"+tasks[i-1]+"' name='"+tasks[i-1]+"'><bpmn:incoming>"+sequenceflows[i-2]+"</bpmn:incoming></bpmn:task>";
    } else {
    bpmntasks[i-1] = "<bpmn:task id='"+tasks[i-1]+"' name='"+tasks[i-1]+"'><bpmn:outgoing>"+sequenceflows[i-1]+"</bpmn:outgoing><bpmn:incoming>"+sequenceflows[i-2]+"</bpmn:incoming></bpmn:task>";
    }

bpmntasksString=bpmntasksString+bpmntasks[i-1];
//alert(bpmntasksString);

}

    for (j=1; j < countSteps; j++) {

        if (((j)>0) && ((j)<countSteps)){
        bpmnsequenceflows[j-1]="<bpmn:sequenceFlow id='"+sequenceflows[j-1]+"' sourceRef='"+tasks[j-1]+"' targetRef='"+tasks[j]+"' />";
        }
        bpmnsequenceflowsString=bpmnsequenceflowsString+bpmnsequenceflows[j-1];
//alert(bpmnsequenceflowsString);

    }

//finally create Annotations
for (i=1; i <= countSteps; i++) {
//here
an[i-1] = [];
for (p=1; p <= 4; p++) {
an[i-1][p-1]= Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
}
//SOS
//alert(an);

var extra_annotations = "<bpmn:textAnnotation id='TextAnnotation_"+an[i-1][0]+"'><bpmn:text>"+CPSVarray[i-1][1]+"</bpmn:text></bpmn:textAnnotation><bpmn:association id='Association_"+an[i-1][0]+"' sourceRef='"+tasks[i-1]+"' targetRef='TextAnnotation_"+an[i-1][0]+"' /><bpmn:textAnnotation id='TextAnnotation_"+an[i-1][1]+"'><bpmn:text>"+CPSVarray[i-1][2]+"</bpmn:text></bpmn:textAnnotation><bpmn:association id='Association_"+an[i-1][1]+"' sourceRef='"+tasks[i-1]+"' targetRef='TextAnnotation_"+an[i-1][1]+"' /><bpmn:textAnnotation id='TextAnnotation_"+an[i-1][2]+"'><bpmn:text>"+CPSVarray[i-1][3]+"</bpmn:text></bpmn:textAnnotation><bpmn:association id='Association_"+an[i-1][2]+"' sourceRef='"+tasks[i-1]+"' targetRef='TextAnnotation_"+an[i-1][2]+"' /><bpmn:textAnnotation id='TextAnnotation_"+an[i-1][3]+"'><bpmn:text>"+CPSVarray[i-1][4]+"</bpmn:text></bpmn:textAnnotation><bpmn:association id='Association_"+an[i-1][3]+"' sourceRef='"+tasks[i-1]+"' targetRef='TextAnnotation_"+an[i-1][3]+"' />";
//SOS
//alert(extra_annotations);
bpmnannotationString = bpmnannotationString + extra_annotations;
}

//var n = sequenceflowsString.slice(0, -1);
//alert(sequenceflowsString+":");
sequenceflowsString=sequenceflowsString.slice(0, -1);
elements=tasksString+sequenceflowsString; //here3
//alert(elements);

bpmnXML2=bpmnXML2+"[[Category:BPMN]]{{#set:Process|id="+process+"|label="+process;
bpmnXML2=bpmnXML2+"|has_element=";
bpmnXML2=bpmnXML2+elements;
bpmnXML2=bpmnXML2+"|+sep=,}}<div id='processXml' class='toccolours mw-collapsible mw-collapsed'>";
bpmnXML2=bpmnXML2+"The following code shows the XML Serialization of the Process:<div class='mw-collapsible-content'>";

//bpmnXML2=bpmnXML;

var p1 = "<"+"?"+" xml version='1.0' encoding='UTF-8' "+"?"+">";
bpmnXML=bpmnXML+encodeURIComponent(p1);
bpmnXML=bpmnXML+"<bpmn:definitions xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:bpmn='http://www.omg.org/spec/BPMN/20100524/MODEL' xmlns:bpmndi='http://www.omg.org/spec/BPMN/20100524/DI' xmlns:dc='http://www.omg.org/spec/DD/20100524/DC' xmlns:di='http://www.omg.org/spec/DD/20100524/DI' id='Definitions_1' targetNamespace='http://bpmn.io/schema/bpmn'>";

bpmnXML=bpmnXML+"<bpmn:process id='"+process+"' isExecutable='false'>";
bpmnXML=bpmnXML+bpmntasksString+bpmnsequenceflowsString+bpmnannotationString+"</bpmn:process>";
bpmnXML=bpmnXML+"<bpmndi:BPMNDiagram id='BPMNDiagram_1'><bpmndi:BPMNPlane id='BPMNPlane_1' bpmnElement='"+process+"'>";
var x = [];

//Draw Task boxes
for (i=1; i <= countSteps; i++) {

x[i-1] = ((i-1)*150)+150;
bpmnShapes[i-1] = "<bpmndi:BPMNShape id='"+tasks[i-1]+"_di' bpmnElement='"+tasks[i-1]+"'><dc:Bounds x='"+x[i-1]+"' y='366' width='100' height='120' /></bpmndi:BPMNShape>";

bpmnShapesString = bpmnShapesString + bpmnShapes[i-1];
//alert(bpmnShapesString);

//add annotations
//here2
//var xann = [], yann = [], xannm =[], yannm =[];

for (k=1; k <= 4; k++) {

//alert(x[i-1]);
//if (k<=2) {
//xann[k-1] = x[i-1] - 100 - 10 + (k-1)*110;
xann[k-1] = x[i-1] - 100;
yann[k-1] = 126 - (5-k)*24 - 30 + (k-1)*8;
var h=30;
if (k==1) {
h=120-10;
yann[k-1] = 0;
}
if (k==2) {
h=150-10;
yann[k-1] = 120;
}
if (k==3) {
yann[k-1] = 270;
h=60-10;
}
if (k==4) {
yann[k-1] = 330;
}
//xannm[k-1] = (x[i-1] + 50)/2;
xannm[k-1] = xann[k-1];
yannm[k-1] = yann[k-1] + h;
//alert(yannm[k-1]);
//}
//if (k>=3) {
//xann[k-1] = x[i-1] - 100 - 10 + (k-3)*110;
//yann[k-1] = 126 - 67;
//xannm[k-1] = (x[i-1] + 50) - k*2;
//yannm[k-1] = yann[k-1] + 30;
//alert(yannm[k-1]);
//}

//here4
bpmnAnnotations[k-1] = "<bpmndi:BPMNShape id='TextAnnotation_"+an[i-1][k-1]+"_di' bpmnElement='TextAnnotation_"+an[i-1][k-1]+"'><dc:Bounds x='"+xann[k-1]+"' y='"+yann[k-1]+"' width='140' height='"+h+"' /></bpmndi:BPMNShape><bpmndi:BPMNEdge id='Association_"+an[i-1][k-1]+"_di' bpmnElement='Association_"+an[i-1][k-1]+"'><di:waypoint xsi:type='dc:Point' x='"+x[i-1]+"' y='366' /><di:waypoint xsi:type='dc:Point' x='"+xannm[k-1]+"' y='"+yannm[k-1]+"' /></bpmndi:BPMNEdge>";

bpmnAnnShapesString = bpmnAnnShapesString + bpmnAnnotations[k-1];
//alert(bpmnAnnShapesString);

}

}

bpmnXML=bpmnXML+bpmnShapesString+bpmnAnnShapesString;
//alert(bpmnXML);

for (i=1; i < countSteps; i++) {
var x1 = ((i-1)*150)+150+100;
var x2 = ((i)*150)+150;
var x3 = x1-6;
var y1 = 366+40;
var y2 = 366+30;
var xStart = x[i-1]+100;
var x12 = (x[i-1]+x[i])/2;
//SOS
//alert(x12);
bpmnEdges[i-1] = "<bpmndi:BPMNEdge id='"+sequenceflows[i-1]+"_di' bpmnElement='"+sequenceflows[i-1]+"'><di:waypoint xsi:type='dc:Point' x='"+xStart+"' y='"+y1+"' /><di:waypoint xsi:type='dc:Point' x='"+x[i]+"' y='"+y1+"' /><bpmndi:BPMNLabel><dc:Bounds x='"+x12+"' y='"+y2+"' width='90' height='20' /></bpmndi:BPMNLabel></bpmndi:BPMNEdge>";

bpmnEdgesString = bpmnEdgesString + bpmnEdges[i-1];
//alert(bpmnEdgesString);
}

bpmnXML=bpmnXML+bpmnEdgesString+"</bpmndi:BPMNPlane></bpmndi:BPMNDiagram></bpmn:definitions>";
bpmnXML3=bpmnXML3+"</div></div>";
bpmnXML=encodeURIComponent(bpmnXML);
bpmnXML2=encodeURIComponent(bpmnXML2);
bpmnXML3=encodeURIComponent(bpmnXML3);
//alert(bpmnXML);
//alert(bpmnXML2);
//SOS
//alert(bpmnXML3);

document.getElementById("createBPMN").innerHTML = bpmnXML;
document.getElementById("createBPMN2").innerHTML = bpmnXML2;
document.getElementById("createBPMN3").innerHTML = bpmnXML3;
document.getElementById("createBPMN_result").innerHTML = "OK";

document.getElementById("myBar").style.width = "50%";
document.getElementById("myBar").innerHTML = "50%";
//document.getElementById("img1").src="/mw/check.png";
//autocontinue=3;
}

function saveBPMN(){

var a1 = document.getElementById("createBPMN").innerHTML;
var a2 = document.getElementById("createBPMN2").innerHTML;
var a3 = document.getElementById("createBPMN3").innerHTML;
//alert(a1);
//alert(a2);
//alert(a3);
var edittokentmp = document.getElementById("code").innerHTML;
edittokentmp = edittokentmp.slice(1, (edittokentmp.length-4));

//alert("Ξεκινά η προσθήκη Wiki σελίδας με BPMN σχετική πληροφορία..."+edittokentmp);
//var url = document.getElementById("URLin").innerHTML+"_BPMN-"+Math.floor((Math.random() * 1000000000) + 1);
var url = document.getElementById("URLin").innerHTML+"_BPMN";

var sectiotitleIN="Section A";
var appendtextIN=a2+a1+a3;
appendtextIN = decodeURIComponent(appendtextIN);
//alert(url);
//alert(sectiotitleIN);
//alert(appendtextIN);
var obj, dbParam, xmlhttp, myObj, myObj2, x, y, txt2 = "";

xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
            txt22 = JSON.stringify(myObj[x].result);
//alert(edittokentmp);
//alert (txt22);
        }
       
document.getElementById("saveBPMN").innerHTML = txt22;
BPMNwikipage = "<html><a href='http://"+thisServerplusFolder+"/index.php?title="+url+"'>BPMN wiki σελίδα</a></html>";
    }

};

xmlhttp.open("POST", thisServerFolder+"/api.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("action=edit&format=json&title="+url+"&appendtext="+appendtextIN+"&token="+edittokentmp+"%2B%5C&utf8=1");

document.getElementById("myBar").style.width = "60%";
document.getElementById("myBar").innerHTML = "60%";
//document.getElementById("img1").src="/mw/check.png";
//autocontinue=5;
BPMNwikipage = "<html><a href='http://"+thisServerplusFolder+"/index.php?title="+url+"'>BPMN Wiki σελίδα</a></html>";

}

function saveBPMNfile(){
//https://github.com/bpmn-io/bpmn-js-examples/blob/master/url-viewer/README.md
//https://stackoverflow.com/questions/15722765/saving-a-text-file-on-server-using-javascript
var obj, dbParam, xmlhttp, myObj, myObj2, x, y, txt = "";
 filenameX = "filename="+document.getElementById("URLin").innerHTML;
    dataa = filenameX+"&dataa="+document.getElementById("createBPMN").innerHTML;// this is your data that you want to pass to the server (could be json)


//dataa=JSON.stringify(dataa);
//alert(dataa);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
            txt = JSON.stringify(myObj);

                //document.getElementById("txtHint").innerHTML = this.responseText;

            }//alert(txt);
        };
//SOS
//alert(dataa);

        xmlhttp.open("POST", "http://"+thisServerplusFolder+"/BPMN/saveBPMNfile.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(dataa);

document.getElementById("saveBPMNfile").innerHTML = "Saved!";
document.getElementById("myBar").style.width = "70%";
document.getElementById("myBar").innerHTML = "70%";
document.getElementById("img6").src="../BPMN/img/check.png";
//autocontinue=6;
}

function openBPMN(){
  // the diagram we are going to display
  //var bpmnXMLi;
    var BpmnViewer = window.BpmnJS;
    var BpmnViewer_big = window.BpmnJS;

  // BpmnJS is the BPMN viewer instance
  //var viewer = new BpmnJS({ container: '#canvas' });
    var viewer = new BpmnViewer({ container: '#canvas' });
    var viewer_big = new BpmnViewer_big({ container: '#canvas_big' });

   path_bpmn = "http://"+thisServerplusFolder+"/BPMN/diagrams/"+document.getElementById("URLin").innerHTML+"_BPMN.bpmn";

path_bpmn = myhost + "BPMN/diagrams/" +document.getElementById("URLin").innerHTML+"_BPMN.bpmn";

//alert(path_bpmn);

var xhr = new XMLHttpRequest();

xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
        viewer.importXML(xhr.response, function(err) {
          if (!err) {
//alert("OK1");
//autocontinue=7;
            console.log('success!');
            viewer.get('canvas').zoom('fit-viewport');
          } else {
            console.log('something went wrong:', err);
//alert("Δεν έχετε εισάγει ή επιλέξει σελίδα Wiki");
          }
        });
    }
};

xhr.open('GET', path_bpmn, true);
xhr.send(null);

//i removed below for simplicity
//(document.location.href).substring(0,(document.location.href).length-9)+"diagrams/"+document.getElementById('URLin').innerHTML+"_BPMN.bpmn"

bpmnEmbed = "<html><script src='http://"+thisServerplusFolder+"/BPMN/bpmn-io-dist/bpmn-viewer.js'><\/script><div id='canvas'><\/div><script>"+"var BpmnViewer = window.BpmnJS; var viewer = new BpmnViewer({ container: '#canvas' });  var path_bpmn ='"+ path_bpmn +"';var xhr = new XMLHttpRequest();xhr.onreadystatechange = function() {    if (xhr.readyState === 4) {        viewer.importXML(xhr.response, function(err) {          if (!err) {            console.log('success!');            viewer.get('canvas').zoom('fit-viewport');          } else {            console.log('something went wrong:', err);          }        });    }};xhr.open('GET', path_bpmn, true);xhr.send(null);";
bpmnEmbed = bpmnEmbed + "<\/script><\/html>";

//alert(bpmnEmbed);

var xhr2 = new XMLHttpRequest();

xhr2.onreadystatechange = function() {
    if (xhr2.readyState === 4)  {
        viewer_big.importXML(xhr2.response, function(err) {

          if (!err) {
//alert("OK1");
            console.log('success!');
            viewer_big.get('canvas_big').zoom('fit-viewport');
          } else {
            console.log('something went wrong:', err);
//alert("OK2");
          }
        });
    }

};
xhr2.open('GET', path_bpmn, true);
xhr2.send(null);

if ((document.getElementById("URLin").innerHTML)) {
document.getElementById("myBar").style.width = "80%";
document.getElementById("myBar").innerHTML = "80%";
document.getElementById("img6").src="../BPMN/img/check.png";
} else {
alert("Δεν έχετε εισάγει ή επιλέξει σελίδα Wiki");
}
path_bpmn_href = encodeURIComponent("<html><a href='" + path_bpmn + "'>BPMN στο repository<\/a><\/html>");

}

function createCPSVarray(){
cpsvpage=document.getElementById("parsedWikipage").innerHTML;
var n1from =0;
var n1to =0;
var n2from =0;
var n2to =0;
var n3from =0;
var n3to =0;
var n4from =0;
var n4to =0;
var htmlfromCPSV="";
var tablerows=document.getElementById("countBPMNsteps").innerHTML;
var i=0;
var tmp="";


htmlfromCPSV=htmlfromCPSV+"<table id='HtmlTableFromCPSV' class='HTMLtable'><thead><tr><th>Α.Α.</th><th>Βήμα Διαδικασίας</th><th>Θεσμικό Πλαίσιο- Διοικητική Πρακτική</th><th>Εμπλεκόμενος Αρμόδιος</th><th>Χρόνος Διεκπεραίωσης Βήματος</th></tr></thead><tbody>";

n0from = cpsvpage.indexOf("Α.Α."); 
cpsvpage = cpsvpage.substring(n0from, cpsvpage.length);
if (ispageCPSVbased == false) {
//n0from = cpsvpage.indexOf("wikitable"); 
//cpsvpage = cpsvpage.substring(n0from, cpsvpage.length);
}
//alert(cpsvpage);

  // create X table rows, each with Y cells
  for (i=1; i <= tablerows; i++) {
CPSVarray[i-1] = [];
    htmlfromCPSV=htmlfromCPSV+"<tr><td>"+i+"</td>";  // DOM method for creating table rows 
    CPSVarray[i-1][0] = i;   
    n1from = cpsvpage.indexOf("Βήμα Διαδικασίας")+28; 
    n1to = cpsvpage.indexOf("Θεσμικό")-21;
    htmlfromCPSV=htmlfromCPSV+"<td>"+cpsvpage.substring(n1from, n1to)+"</td>";   
//alert(n1from+"-"+n1to+":"+cpsvpage.substring(n1from, n1to)); 
    CPSVarray[i-1][1] = cpsvpage.substring(n1from, n1to);  
    
    n2from = cpsvpage.indexOf("Θεσμικό Πλαίσιο")+48; 
    n2to = cpsvpage.indexOf("Εμπλεκόμενος")-21;
    htmlfromCPSV=htmlfromCPSV+"<td>"+cpsvpage.substring(n2from, n2to)+"</td>";  
    CPSVarray[i-1][2] = cpsvpage.substring(n2from, n2to);
//alert(n2from+"-"+n2to+":"+cpsvpage.substring(n2from, n2to)); 

    n3from = cpsvpage.indexOf("Εμπλεκόμενος")+33; 
    n3to = cpsvpage.indexOf("Χρόνος Διεκπεραίωσης Βήματος")-21;
    htmlfromCPSV=htmlfromCPSV+"<td>"+cpsvpage.substring(n3from, n3to)+"</td>";  
    CPSVarray[i-1][3] = cpsvpage.substring(n3from, n3to);
//alert(n3from+"-"+n3to+":"+cpsvpage.substring(n3from, n3to)); 

    n4from = cpsvpage.indexOf("Χρόνος Διεκπεραίωσης Βήματος")+40; 
    n4to = cpsvpage.indexOf("</table>")-20;
    htmlfromCPSV=htmlfromCPSV+"<td>"+cpsvpage.substring(n4from, n4to)+"</td></tr>";  
    CPSVarray[i-1][4] = cpsvpage.substring(n4from, n4to);
//alert(n4from+"-"+n4to+":"+cpsvpage.substring(n4from, n4to)); 

    //alert(htmlfromCPSV);
    cpsvpage = cpsvpage.substring(n4to+20+13, cpsvpage.length);
    //alert(cpsvpage);
  }
htmlfromCPSV=htmlfromCPSV+"</tbody></table>";
    //alert(htmlfromCPSV);
}

function CPSV2HTML(){
cpsvpage=document.getElementById("parsedWikipage").innerHTML;
var n1from =0;
var n1to =0;
var n2from =0;
var n2to =0;
var n3from =0;
var n3to =0;
var n4from =0;
var n4to =0;
var htmlfromCPSV="";
var tablerows=document.getElementById("countBPMNsteps").innerHTML;
var i=0;
var tmp="";


htmlfromCPSV=htmlfromCPSV+"<table id='HtmlTableFromCPSV' class='HTMLtable'><thead><tr><th>Α.Α.</th><th>Βήμα Διαδικασίας</th><th>Θεσμικό Πλαίσιο- Διοικητική Πρακτική</th><th>Εμπλεκόμενος Αρμόδιος</th><th>Χρόνος Διεκπεραίωσης Βήματος</th></tr></thead><tbody>";

n0from = cpsvpage.indexOf("Α.Α."); 
cpsvpage = cpsvpage.substring(n0from, cpsvpage.length);
if (ispageCPSVbased == false) {
//n0from = cpsvpage.indexOf("wikitable"); 
//cpsvpage = cpsvpage.substring(n0from, cpsvpage.length);
}
//alert(cpsvpage);

  // create X table rows, each with Y cells
  for (i=1; i <= tablerows; i++) {
CPSVarray[i-1] = [];
    htmlfromCPSV=htmlfromCPSV+"<tr><td>"+i+"</td>";  // DOM method for creating table rows 
    CPSVarray[i-1][0] = i;   
    n1from = cpsvpage.indexOf("Βήμα Διαδικασίας")+28; 
    n1to = cpsvpage.indexOf("Θεσμικό")-21;
    htmlfromCPSV=htmlfromCPSV+"<td>"+cpsvpage.substring(n1from, n1to)+"</td>";   
//alert(n1from+"-"+n1to+":"+cpsvpage.substring(n1from, n1to)); 
    CPSVarray[i-1][1] = cpsvpage.substring(n1from, n1to);  
    
    n2from = cpsvpage.indexOf("Θεσμικό Πλαίσιο")+48; 
    n2to = cpsvpage.indexOf("Εμπλεκόμενος")-21;
    htmlfromCPSV=htmlfromCPSV+"<td>"+cpsvpage.substring(n2from, n2to)+"</td>";  
    CPSVarray[i-1][2] = cpsvpage.substring(n2from, n2to);
//alert(n2from+"-"+n2to+":"+cpsvpage.substring(n2from, n2to)); 

    n3from = cpsvpage.indexOf("Εμπλεκόμενος")+33; 
    n3to = cpsvpage.indexOf("Χρόνος Διεκπεραίωσης Βήματος")-21;
    htmlfromCPSV=htmlfromCPSV+"<td>"+cpsvpage.substring(n3from, n3to)+"</td>";  
    CPSVarray[i-1][3] = cpsvpage.substring(n3from, n3to);
//alert(n3from+"-"+n3to+":"+cpsvpage.substring(n3from, n3to)); 

    n4from = cpsvpage.indexOf("Χρόνος Διεκπεραίωσης Βήματος")+40; 
    n4to = cpsvpage.indexOf("</table>")-20;
    htmlfromCPSV=htmlfromCPSV+"<td>"+cpsvpage.substring(n4from, n4to)+"</td></tr>";  
    CPSVarray[i-1][4] = cpsvpage.substring(n4from, n4to);
//alert(n4from+"-"+n4to+":"+cpsvpage.substring(n4from, n4to)); 

    //alert(htmlfromCPSV);
    cpsvpage = cpsvpage.substring(n4to+20+13, cpsvpage.length);
    //alert(cpsvpage);
  }
htmlfromCPSV=htmlfromCPSV+"</tbody></table>";
    //alert(htmlfromCPSV);

    document.getElementById("CPSV2HTML").innerHTML = htmlfromCPSV;
cpsv2HtmlTable = htmlfromCPSV;

document.getElementById("myBar").style.width = "30%";
document.getElementById("myBar").innerHTML = "30%";
//document.getElementById("img1").src="/mw/check.png";
}

function HTML2JSON_f(){
var html = document.getElementById('CPSV2HTML').innerHTML;
//alert(html);
//console.log(html);
var json = html2json(html);
//console.log(JSON.stringify(json, ' ', ' '));
//console.assert(html === json2html(json));
    document.getElementById("HTML2JSON").innerHTML = json;

}


function HTML2JSONX(){
$('#HTML2JSON').click( function() {
  var table = $('#CPSV2HTML').tableToJSON(); // Convert the table into a javascript object
  //console.log(table);
  //alert(JSON.stringify(table));
});
}

function HTML2JSONXY(){
//http://jsfiddle.net/u7nKF/1/

var myRows = { myRows: [] };

var $th = $('table th');
$('table tbody tr').each(function(i, tr){

    var obj = {}, $tds = $(tr).find('td');
    $th.each(function(index, th){
        obj[$(th).text()] = $tds.eq(index).text();
    });
    myRows.myRows.push(obj);
});
//alert(JSON.stringify(myRows));
}

function HTML2JSON(){

   var json = $('#HtmlTableFromCPSV').tableToJSON();
   document.getElementById("HTML2JSON").innerHTML = JSON.stringify(json);

//alert(JSON.stringify(json));
document.getElementById("myBar").style.width = "40%";
document.getElementById("myBar").innerHTML = "40%";
document.getElementById("img5").src=thisServerFolder+"/BPMN/img/check.png";
}

function HTML2JSON2(){
//  This gives you an HTMLElement object
var element = document.getElementById('CPSV2HTML');
//  This gives you a string representing that element and its content
var html = element.outerHTML;       
//  This gives you a JSON object that you can send with jQuery.ajax's `data`
// option, you can rename the property to whatever you want.
var data = { html: html }; 

//  This gives you a string in JSON syntax of the object above that you can 
// send with XMLHttpRequest.
var json = JSON.stringify(data);

//var HtmlToJsonString = JSON.stringify(document.getElementById('CPSV2HTML').outerHTML);

    document.getElementById("HTML2JSON").innerHTML = json;

}

function countSteps(){
createCPSVarray();
var temp1 = "";
//var count1 = (temp1.match(/is/g) || []).length;
//console.log(count1);

xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        //for (x in myObj) {
            temp1 = JSON.stringify(myObj);
            var count1 = (temp1.match(/Βήμα Διαδικασίας/g) || []).length;
            var count2 = (temp1.match(/Βήματα Διαδικασίας/g) || []).length;

//var n1 = temp1.search("Βήμα Διαδικασίας");
//var n2 = temp1.search("Βήματα διαδικασίας");
//use instead global variables
n1 = temp1.search("Βήμα Διαδικασίας");
n2 = temp1.search("Βήματα διαδικασίας");

//SOS new
//if (ispageCPSVbased == false){
// n2=n1;
//}

//alert(n1+":"+n2);
            if (n1>-1) {
            if (ispageCPSVbased == false){
            ispageCPSVbased = true;
            //document.getElementById("btn1-3").style.visibility = "visible";
            //document.getElementById("btn1-4").style.visibility = "visible";
            n2=n1; //SOS new
//alert(n1+":"+n2);
            }
            }
            if (n2>-1) {
            count1 = count2;
            //temp1 = countStepsnoCPSV(temp1); //also works
             countStepsnoCPSV(temp1);
            temp1 = noCPSVpage;
            count1 = (temp1.match(/<tr>/g) || []).length - 1;
            ispageCPSVbased = false;

            //createnoCPSVarray();

            }else{
            //alert("No CPSV-based & no Steps for BPMN found!!!");
            //autocontinue=0;
            }

//alert(temp1); 
//alert(count1);
         processSteps = count1;
         document.getElementById("countBPMNsteps").innerHTML = count1;
         document.getElementById("parsedWikipage").innerHTML = temp1 ;
         //document.getElementById("parsedWikipage").style.visibility = "hidden";
         document.getElementById("parsedWikipage").style.display = "none";
         document.getElementById("isCPSV").innerHTML  = ispageCPSVbased;
autocontinue=1;
    }

};
xmlhttp.open("POST", thisServerFolder+"/api.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("action=parse&format=json&page="+document.getElementById("URLin").innerHTML+"&prop=text&disablelimitreport=1&disableeditsection=1&disabletoc=1&utf8=1");


document.getElementById("myBar").style.width = "25%";
document.getElementById("myBar").innerHTML = "25%";
//document.getElementById("img1").src="/mw/check.png";
}

function countStepsnoCPSV(strin){
noCPSVpage = "";
//alert(noCPSVpage);
var strinHere = strin;
var i = strin.indexOf("Βήματα διαδικασίας");
var i2 = strin.indexOf("Βήμα διαδικασίας");
var i3 = strin.indexOf("Βήμα Διαδικασίας"); //Beware of string uppoercase, lowercase etc.)

//strinHere = strinHere.substring(strinHere.indexOf("<table class="),strinHere.indexOf("table>") + 6);
strinHere = strinHere.substring(strinHere.indexOf("<th>Βήματα διαδικασίας")-51,strinHere.length);
//alert(n1+":"+n2+" i:"+i+" i2:"+i2" i3:"+i3);
//alert(strinHere);

//alert(strin);
//if (n1==n2) {
//strinHere = strin.substring(strin.indexOf("Βήμα διαδικασίας")-51,strin.length);
//alert(strinHere);
//}


if (i == -1) {
strinHere = strin.substring(i3-55, strin.length);
//strinHere = strinHere.substring(0, strinHere.indexOf("Διαδικασίες</span></h2><table") + 23);
//alert(strinHere);
}
strinHere = strinHere.substring(0, strinHere.indexOf("table>") + 6);



noCPSVpage = noCPSVpage + strinHere;

//alert("Page:"+noCPSVpage);
createnoCPSVarray();

return noCPSVpage;
}

function createnoCPSVarray(){
var rowa = "";
var temp1 = "";
var tablerows =0;
var cell ="";
//countSteps();
//here6
            temp1 = noCPSVpage;
//alert(temp1);
            tablerows = (temp1.match(/<tr>/g) || []).length - 1;
            ispageCPSVbased = false;
if  (temp1.indexOf("για κάθε βήμα") > -1) { 
temp1 = temp1.substring(temp1.indexOf("για")+27, temp1.indexOf("</table>")+8);
}  else {
temp1 = temp1.substring(temp1.indexOf("Βήματος")+17, temp1.indexOf("</table>")+8);
}

//SOS 
//alert(temp1);
for (i=0; i < tablerows ; i++) {
  noCPSVarray[i] = [];
  rowa = temp1.substring(temp1.indexOf("<tr>"), temp1.indexOf("</tr>")+5);
//alert("row:"+rowa);
  for (j=0; j <= 4; j++) {
    cell = rowa.substring(rowa.indexOf("<td>")+4, rowa.indexOf("</td>")-2);

//alert(cell); 

    cell = cell.replace(/<p>/g, " ");
    //cell = cell.replace(/p>/g, " ");
    //cell = cell.replace(/n</g, " ");
    cell = cell.replace(/<b>/g, " ");
    //cell = cell.replace(/b>/g, " ");
    //cell = cell.replace(/undefined/g, " ");
    cell = cell.replace(/\n/g, " ");
    cell = cell.replace(/(\r\n|\n|\r)/gm,"");
    cell = cell.replace(/<\/p>/gm, "");
    cell = cell.replace(/<\/b>/gm, "");
    cell = cell.replace(/\n/g, " ");
    cell = cell.replace(/<\/b>/gm, "");
    cell = cell.replace(/\n/g, " ");
    cell = cell.replace(/\n/g,' ').replace(/\r/g,' ');
    //cell = cell.replace(/<\//g, " ");
    cell = cell.replace(/\\n/g, " ");
//\n
    //cell = cell.replace(/</p>/g, " ");
//  \n<
    cell = cell.replace(/<\p>/g, " ");
    cell = cell.replace(/\n/g, " ");
    //cell = cell.replace(//n/g, " ");
    cell = cell.replace(/[\r\n]/g, "");
    cell = cell.replace(/[\n]/g, "");
    
    cell = cell.split("\n").join(" ");
    //cell = cell.replace(/./g, "_");

    cell = encodeURIComponent(cell);
//alert(cell);
    noCPSVarray[i][j] = cell;
    rowa = rowa.substring(rowa.indexOf("</td>")+4, rowa.length);
  }
    temp1 = temp1.substring(temp1.indexOf("</tr>")+2, temp1.length);
//alert(temp1);
}
CPSVarray = noCPSVarray;
//SOS 
//alert("Array:"+noCPSVarray);
}

function CalladdBPMNsection(){
    //chk= addBPMNsection(url, sectiotitleIN, appendtextIN);
       
       //alert(txt22);



}

function getToken(){
//var edittokentmp="";
//alert("Ξεκινά..."+edittoken);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        //for (x in myObj) {
            edittoken = JSON.stringify(myObj.query.tokens.csrftoken);
            //edittoken = JSON.stringify(myObj[x].tokens);
            document.getElementById("BPMNedit").style.visibility="visible";

if (edittoken.length>4){
document.getElementById("btn1-6").style.visibility="visible";
document.getElementById("btn2").style.display="inline";
document.getElementById("btn2b").style.display="inline";
document.getElementById("btn2c").style.display="inline";
document.getElementById("btn2").style.visibility="visible";
document.getElementById("btn2b").style.visibility="visible";
document.getElementById("btn2c").style.visibility="visible";
//autocontinue=4;
} 
//alert(edittoken);

        //}
//edittoken = edittoken.slice(0, (edittokentmp.length-3));
         document.getElementById("code").innerHTML = edittoken;

    }

};
xmlhttp.open("POST", thisServerFolder+"/api.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("action=query&format=json&meta=tokens");



document.getElementById("myBar").style.width = "55%";
document.getElementById("myBar").innerHTML = "55%";
//document.getElementById("img1").src="/mw/check.png";
//return edittoken;
}

function CalladdBPMNsection(){
    //chk= addBPMNsection(url, sectiotitleIN, appendtextIN);
       
       //alert(txt22);

}


function checkStep(){
//alert(document.getElementById("txtHint").innerHTML);
var str = document.getElementById("txtHint").innerHTML;
var n = str.search("Βήμα Διαδικασίας");
//alert(n);
if (n > -1) {
//alert(n);
ispageCPSVbased = true;
document.getElementById("btn1-3").style.visibility="visible";
document.getElementById("btn1-4").style.visibility="visible";



document.getElementById("myBar").style.width = "20%";
document.getElementById("myBar").innerHTML = "20%";
document.getElementById("img1").src=thisServerFolder+"/BPMN/img/check.png";
document.getElementById("messageMetadata").innerHTML = "Result is that, ";
document.getElementById("message").innerHTML = " Wiki page is CPSV-based";
messages = messages + "Result is that, " + " Wiki page is CPSV-based";
//alert(myhost);
}
document.getElementById("isCPSV").innerHTML  = ispageCPSVbased;
return true;
}

function checkStep2(){
//alert(document.getElementById("txtHint").innerHTML);
var str = document.getElementById("txtHint").innerHTML;
var n = str.search("Βήμα Διαδικασίας");
//alert(n);
if (n > -1) {
//alert(n);
document.getElementById("btn2").style.visibility="visible";
document.getElementById("btn2b").style.visibility="visible";
document.getElementById("btn2c").style.visibility="visible";

document.getElementById("myBar").style.width = "20%";
document.getElementById("myBar").innerHTML = "20%";
document.getElementById("img1").src=thisServerFolder+"/BPMN/img/check.png";
document.getElementById("messageMetadata").innerHTML = "Result is that, ";
document.getElementById("message").innerHTML = " Wiki page is CPSV-based";
//alert(myhost);
}
return true;
}

function addBPMNsection(url, sectiotitleIN, appendtextIN){
addBPMNsectioncounter = 0;
//

var a = document.getElementById("code").innerHTML;
var edittokentmp = a.slice(1, (a.length-4));

//alert("Ξεκινά η προσθήκη ενότητας με συνδέσμους σε BPMN σχετική πληροφορία..."+edittokentmp);
//alert(url);
//alert(sectiotitleIN);
//alert(appendtextIN);
var obj, dbParam, xmlhttp, myObj, myObj2, x, y, txt2 = "";
//obj = { "parse":"templates" };
//dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
            txt22 = JSON.stringify(myObj[x].result);
//alert(edittokentmp);
//alert (txt22);
        }
       
         document.getElementById("BPMN_add").innerHTML = txt22;

if (sectiotitleIN=="BPMN Σύνδεσμος στο Repository") {
document.getElementById("myBar").style.width = "90%";
document.getElementById("myBar").innerHTML = "90%";
}else if (sectiotitleIN=="BPMN Διάγραμμα") {
document.getElementById("myBar").style.width = "95%";
document.getElementById("myBar").innerHTML = "95%";
}else{
document.getElementById("myBar").style.width = "100%";
document.getElementById("myBar").innerHTML = "100%";
document.getElementById("img2").src="../BPMN/img/check.png";
}
//alert(txt22);
//return txt22;
    }

};

xmlhttp.open("POST", thisServerFolder+"/api.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("action=edit&format=json&title="+url+"&section=new&sectiontitle="+sectiotitleIN+"&appendtext="+appendtextIN+"&token="+edittokentmp+"%2B%5C&utf8=1");

//alert(txt22);
//return true;

}


function parseStepTemplate (url){
//alert( 'Parsed result:');
var strSearch = "Βήμα Διαδικασίας";
var obj, dbParam, xmlhttp, myObj, myObj2, x, y, txt = "";
//obj = { "parse":"templates" };
dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
            txt += JSON.stringify(myObj[x].templates) + "<br>";
             
        }
        document.getElementById("txtHint").innerHTML = txt;
        url=url.replace(/ /g,"_");
        document.getElementById("URLin").innerHTML = url;
        
        document.getElementById("inURL").value= url;

        urlsaved = url;
        document.getElementById("bpmnUrl").value = encodeURIComponent("http://"+thisServerplusFolder+"/BPMN/diagrams/"+url+"_BPMN.bpmn");
        //txt1 = txt;
        //document.getElementById("btn1").style.visibility="visible";
document.getElementById("myBar").style.width = "10%";
document.getElementById("myBar").innerHTML = "10%"

    }

};
xmlhttp.open("POST", thisServerFolder+"/api.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("action=parse&format=json&page="+url+"&prop=templates&disablelimitreport=1&disableeditsection=1&disabletoc=1&contentformat=text%2Fx-wiki&contentmodel=wikitext&utf8=1&ascii=1");

//return true;

}


</script>
<script>
function JSON2HTML(sel) {
    var obj, dbParam, xmlhttp, myObj, x, txt = "";
    obj = { "table":sel, "limit":20 };
    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            myObj = JSON.parse(this.responseText);
            txt += "<table border='1'>"
            for (x in myObj) {
                txt += "<tr><td>" + myObj[x].name + "</td></tr>";
            }
            txt += "</table>" 
            document.getElementById("demo").innerHTML = txt;
        }
    };
    xmlhttp.open("POST", "json_demo_db_post.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("x=" + dbParam);
}
</script>
<script>
function addNewSection( summary, content, editToken, wgPageName) {
    $.ajax({
        url: mw.util.wikiScript( 'api' ),
        data: {
            format: 'json',
            action: 'edit',
            title: mw.config.get( wgPageName ),
            section: 'new',
            summary: summary,
            text: content,
            token: editToken
        },
        dataType: 'json',
        type: 'POST',
        success: function( data ) {
            if ( data && data.edit && data.edit.result == 'Success' ) {
                window.location.reload(); // reload page if edit was successful
            } else if ( data && data.error ) {
                alert( 'Error: API returned error code "' + data.error.code + '": ' + data.error.info );
            } else {
                alert( 'Error: Unknown result from API.' );
            }
        },
        error: function( xhr ) {
            alert( 'Error: Request failed.' );
        }
    });
}


function auto(){
//here5
//document.getElementById("messageMetadata").innerHTML = "Starting-";
//document.getElementById("message").innerHTML = " automatic process...";
messages = messages + "<br>Starting..." + " automatic process...<br>";
var u="";
u=document.getElementById("URLin").innerHTML;
//alert(u);
//alert(autocontinue);
if (document.getElementById("auto").checked)  {
if (u.length>=1) { //SOS should be improved
parseStepTemplate(document.getElementById("URLin").innerHTML);
checkStep();
//sleep(1000);
//setTimeout(countSteps, 2000);
countSteps();
//sleep(1000);
getToken();
//alert(u+"-ispageCPSVbased:"+ispageCPSVbased+"...length:"+u.length);

if (autocontinue>=1) {

//if (autocontinue==2) {
//setTimeout(createBPMN, 3000);


//sleep(1000);
createBPMN();
//}
//if (autocontinue==3) {
//setTimeout(getToken, 4000);
//sleep(1000);
getToken();
///}
//if (autocontinue==4) {
//setTimeout(saveBPMN, 5000);
//sleep(1000);
saveBPMN();
//}
//if (autocontinue==5) {
//setTimeout(saveBPMNfile, 7000);
//sleep(1000);
saveBPMNfile();
//}
//if (autocontinue==6) {
//setTimeout(openBPMN, 8000);
//sleep(1000);
openBPMN();
//}
//if (autocontinue==7) {

//sleep(10000);
//addBPMNsection(document.getElementById('inURL').value, 'BPMN Σύνδεσμος στο Repository',path_bpmn_href);

//sleep(11000);
//addBPMNsection(document.getElementById('inURL').value, 'BPMN Διάγραμμα',bpmnEmbed);

//sleep(12000);
//addBPMNsection(document.getElementById('inURL').value, 'BPMN Wiki σελίδα','http://imagnisa.labs.ihu.edu.gr/mw/index.php\?title='+document.getElementById('inURL').value+'_BPMN');
//}
messages = messages + "-finished analysis";
document.getElementById("message").innerHTML = messages ;

setTimeout(auto2, 2000);
setTimeout(auto22, 7000);
setTimeout(auto23, 9000);
setTimeout(auto3, 10000);
setTimeout(auto4, 12000);
setTimeout(auto5, 15000);

}else{
//SOSalert("Ξεκινά...");
}
}else{
//SOSalert("Δεν ικανοποιούνται τα κριτήρια-error code 2");
}
}else{
//SOSalert("Πρέπει να έχετε εισάγει ή επιλέξει όνομα σελίδαs wiki...για τη διαδικασία μετατροπής σε BPMN");
}
//if end checking whether Auto is checked

setTimeout(again, 4000);
}

function again(){
if (autocontinue>=1) {
if (processSteps>=1) {
setTimeout(auto2, 2000);
setTimeout(auto22, 6000);
setTimeout(auto23, 8000);
setTimeout(auto3, 15000);
setTimeout(auto4, 18000);
setTimeout(auto5, 22000);
}
}
}

function auto2(){

messages = messages + "-finished analysis<br>";
document.getElementById("message").innerHTML = messages 
if (ispageCPSVbased==true){
CPSV2HTML();
HTML2JSON();
}
createBPMN();

messages = messages + "-finished BPMN initialization-creation<br>";
document.getElementById("message").innerHTML = messages ;
}

function auto22(){
saveBPMN();
saveBPMNfile();
messages = messages + "-finished BPMN saves<br>";
document.getElementById("message").innerHTML = messages ;
}

function auto23(){
openBPMN();
messages = messages + "-BPMN opened!!!<br>";
document.getElementById("message").innerHTML = messages ;
}

function auto3(){
addBPMNsection(document.getElementById('inURL').value, 'BPMN Σύνδεσμος στο Repository',path_bpmn_href);
messages = messages + "-adding BPMN extra sections to initial wiki page<br>";
document.getElementById("message").innerHTML = messages ;
}

function auto4(){
addBPMNsection(document.getElementById('inURL').value, 'BPMN Διάγραμμα',bpmnEmbed);
messages = messages + "-proceeding!!! adding BPMN extra sections to initial wiki page<br>";
document.getElementById("message").innerHTML = messages ;
}

function auto5(){
addBPMNsection(document.getElementById('inURL').value, 'BPMN Wiki σελίδα',BPMNwikipage);
messages = messages + "-Finished!!! adding BPMN extra sections to initial wiki page<br>FINISHED!!!   ";
messages = messages + "<a href='"+myhost+"index.php?title="+document.getElementById("URLin").innerHTML+"'>Go to initial page...</a>";
document.getElementById("message").innerHTML = messages ;

}



function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
</script>



</head>
<body>

<script>
//edittoken = mw.user.tokens.get( 'editToken' );
//getToken();
//alert("Ξεκινά..."+edittoken);
//alert(edittoken);
//document.getElementById("myBar").style.width="50%";
//document.getElementById("myBar").innerHTML = "50%";
</script>

<div id="S0">
<div class="w3-container w3-tangerine w3-responsive" align="center">
<p class="w3-large">Διαδικασία δημιουργίας BPMN βάσει CPSV+CPOV...</p></div>
<div align="right">Αυτόματη εκτέλεση <input id="auto" type="checkbox" align="right" style="width: 5%;">   <button id="btn-auto" class="w3-button w3-xlarge w3-circle w3-red w3-card-4" style="visibility:visible" type="button" onclick="auto()">+</button></div>
</div>
<div align="left"><div><font color="blue">Εξέλιξη διαδικασίας</font></div></div>
<div id="myProgress">
  <div id="myBar" style="width:5%"></div>
<script>
document.getElementById("myBar").innerHTML= "5%";
</script>
</div>
<div><br></div>
<?php
$myServer = "http://";
$myMWfolder = "/mw";
$message = "<div id='messageArea' draggable='true' style='background-color: lightgreen;'>Message area --> <span id='messageMetadata'>Server"."-folder:</span><span id='message'>".$myServer.$myMWfolder."</span></div>";
echo $message;
?>
<script>
var folder = location.pathname;
var posBPMNfolder = folder.indexOf("BPMN");
var BPMNfolder = folder.substring(0,posBPMNfolder);
//alert(BPMNfolder);

myhost = location.protocol + '//' + location.hostname + BPMNfolder ;
document.getElementById('message').innerHTML=myhost;
//alert(document.getElementById('message').innerHTML);
</script>	



<div class="divTable blueTable w3-responsive">
<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead" style="width:12%">Έλεγχος</div>
<div class="divTableHead" style="width:12%">Βήμα</div>
<div class="divTableHead">Δεδομένα Εισόδου</div>
<div class="divTableHead">Αποτελέσματα</div>
<div class="divTableHead">Επιπλέον Ενέργεια</div>
</div>
</div>
<div class="divTableBody">
<div id="S1" class="divTableRow">
<div class="divTableCell"><img id="img1" src="img/unchecked.png" alt="Check" height="33px" width="36px"></div>
<div class="divTableCell"><div id="BPMN1">
Ξεκινήστε να γράφετε έναν σύνδεσμο URL στο πεδίο:
</div></div>
<div class="divTableCell">
<form> 
URL-τίτλος σελίδας: <input type="text" placeholder="π.χ. Χορήγηση" id="inURL" onkeyup="parseStepTemplate(this.value);
">
</form>
<div id="page-wrapper">
  <p>ή Λίστα σελίδων WIKI</p>
  <label for="ajax">Επιλέξτε τη σελίδα...</label>
  <input type="text" id="ajax" list="json-datalist" placeholder="π.χ. Χορήγηση" onkeyup="parseStepTemplate(this.value)">
  <datalist id="json-datalist"></datalist>
</div>

</div>
<div class="divTableCell"><p>Αρχική ανάλυση Wiki σελίδας: <font color="blue"><span id="txtHint"></span></font></p></div>
<div class="divTableCell">
<button class="button" id="btn1" style="visibility:visible" type="button" onclick="checkStep()">Έλεγχος για CPSV template</button>
<p>H αναλυμένη σελίδα wiki... <span id="parsedWikipage"></span>είναι βασισμένη σε CPSV? <h2><font color="red"><span id="isCPSV"></span></font></h2></p>
</div>
</div>
<div id="S2" class="divTableRow">
<div class="divTableCell"><img id="img5" src="img/unchecked.png" alt="Check" height="33px" width="36px"></div>
<div class="divTableCell">Αυτόματη ανάλυση wiki (CPSV/or not & transformation)</div>
<div class="divTableCell"><p>Όνομα αρχικής σελίδας Wiki που περιγράφει τη διαδικασία: <h3><font color="red"><span id="URLin"></span></font></p></h3><br><button class="button" id="btn1-2" style="visibility:visible" type="button" onclick="countSteps()">Μέτρησε βήματα διαδικασίας...</button><p>Πλήθος βημάτων: <font color="red"><span id="countBPMNsteps"></span></font></p>
</div>
<div class="divTableCell"><button class="button" id="btn1-3" style="visibility:hidden" type="button" onclick="CPSV2HTML()">CPSV2HTML</button><p>CPSV2HTML: <span id="CPSV2HTML"></span></p>
</div>
<div class="divTableCell"><button class="button" id="btn1-4" style="visibility:hidden" type="button" onclick="HTML2JSON()">HTML2JSON</button><p>HTML2JSON: <br><span id="HTML2JSON"></span></p></div>
</div>
<div id="S3" class="divTableRow">
<div class="divTableCell"><img id="img6" src="img/unchecked.png" alt="Check" height="33px" width="36px"></div>
<div class="divTableCell">Δημιουργία BPMN σημειογραφίας και διαγράμματος</div>
<div class="divTableCell"><button class="button" id="btn1-5" style="visibility:visible" type="button" onclick="createBPMN()">Δημιουργία BPMN σημειογραφίας</button>
<div>
<div><br>Αποτέλεσμα: <font color="red"><span id="createBPMN_result"></span></font></div>
<div id="createBPMN" style="display:none;visibility:hidden;"></div>
<div id="createBPMN2" style="display:none;visibility:hidden"></div>
<div id="createBPMN3" style="display:none;visibility:hidden"></div>
</div>
</div>
<div class="divTableCell">
<button class="button" id="btn0" style="visibility:visible" type="button" onclick="getToken()">Κωδικός για αλλαγές</button><p>Κωδικός: <font color="green"><span id="code"></span></font></p>
<button class="button" id="btn1-6" style="visibility:hidden" type="button" onclick="saveBPMN()">Αποθήκευση BPMN σημειογραφίας σε Wiki σελίδα</button><p>Αποτέλεσμα αποθήκευσης: <font color="red"><span id="saveBPMN"></span></font></p></div>
<div class="divTableCell"><button class="button" id="btn1-7" style="visibility:visible" type="button" onclick="saveBPMNfile()">Αποθήκευση BPMN σημειογραφίας σε αρχείο</button><p>Αποτέλεσμα αποθήκευσης αρχείου: <font color="red"><span id="saveBPMNfile"></span></font></p>

</div>
</div>
<div id="S4" class="divTableRow">
<div class="divTableCell"><img id="img2" src="img/unchecked.png" alt="Check" height="33px" width="36px"></div>
<div class="divTableCell"><div id="BPMN2">
Σύνδεσμος από την περιγραφή διαδικασίας στο διάγραμμα BPMN
</div></div>
<div class="divTableCell"><button class="button" id="btn1-8" style="visibility:visible" type="button" onclick="openBPMN()">Προβολή BPMN</button><p>Προβολή BPMN -->δίπλα και κάτω <span id="openBPMN"></span></p></div>
<div class="divTableCell">Εδώ εμφανίζονται επιλογές σε περίπτωση που έχουμε CPSV-based Wiki σελίδα διαδικασίας<br><button class="button" id="btn2" style="visibility:hidden;display:none" type="button" onclick="addBPMNsection(urlsaved, 'BPMN Σύνδεσμος στο Repository',path_bpmn_href)">Προσθήκη BPMN Συνδέσμου στη Wiki σελίδα</button>
<button class="button" id="btn2b" style="visibility:hidden;display:none" type="button" onclick="addBPMNsection(urlsaved, 'BPMN Διάγραμμα',bpmnEmbed)">Ενσωμάτωση BPMN Διαγράμματος στη Wiki σελίδα</button>
<button class="button" id="btn2c" style="visibility:hidden;display:none" type="button" onclick="addBPMNsection(urlsaved, 'BPMN Wiki σελίδα',BPMNwikipage )">Ενσωμάτωση BPMN wiki page στην αρχική Wiki σελίδα</button>
</div>
<div class="divTableCell"><p>Αποτέλεσμα προσθήκης BPMN στην αρχική σελίδα: <h3><font color="red"><span id="BPMN_add"></span></font></h3></p></div>
</div>
<div id="S5" class="divTableRow">
<div class="divTableCell"><img id="img3" src="../BPMN/img/tools.jpg" alt="Check" height="33px" width="36px"></div>
<div class="divTableCell">Εργαλεία</div>
<div class="divTableCell">
<!-- BPMN diagram container -->
<div id="canvas" >Μικρογραφία BPMN</div>
</div>
<div class="divTableCell" >
<form action="openBPMN.php" method="get">
Άνοιγμα αρχείου BPMN σε εξωτερικό εργαλείο φόρτωσης<input type="hidden" id="bpmnUrl" name="bpmnUrl" value="http://.../xxx.bpmn">
<input type="submit">
</form><br>
</div>
<div class="divTableCell">
<div id="BPMNedit" style="visibility:hidden;">
<a href="../BPMN/BPMNedit/BPMNedit.php" id="">Επεξεργασία</a>
</div>
</div>
</div>
<div class="divTableRow" style="display:none">
<div class="divTableCell"><img id="img4" src="/img/unchecked.png" alt="Check" height="33px" width="36px"></div>
<div class="divTableCell">cell1_4</div>
<div class="divTableCell">cell2_4</div>
<div class="divTableCell">cell3_4</div>
<div class="divTableCell">cell4_4</div>
</div>
</div>
</div>




<div align="center"><h3>Αναπαράσταση διαδικασίας BPMN</h3></div>
<div id="canvas_big" style="height: 500px"></div>



<script>
// Get the <datalist> and <input> elements.
var dataList = document.getElementById('json-datalist');
var input = document.getElementById('ajax');

var obj, dbParam, xmlhttp, jsonOptions, myObj, myObj2 , myObj3, myObj4, x, y, txt = "";


xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
//alert(JSON.stringify(myObj));
       for (x in myObj){
         
         if (x=="query") {
            myObj2  = JSON.stringify(myObj[x]);
            //alert(myObj2+"-"+x);
//for (i in myObj.cars) {
//    x += myObj.cars[i];
//}
myObj3 = JSON.parse(myObj2);
           // alert(myObj3);

            for (y in myObj3.allpages) {
            myObj4 = JSON.stringify(myObj3.allpages[y].title);
        //parse ""
        myObj4  = myObj4.substring(1,myObj4.length-1);
        // Create a new <option> element.
        var option = document.createElement('option');
        // Set the value using the item in the JSON array.
        //replace space with _
        //myObj4 = myObj4.replace(/ /g, "_");
        option.value = myObj4;
        // Add the <option> element to the <datalist>.
        dataList.appendChild(option);


          //alert(myObj4+"-"+y);
          }
          }

      // Update the placeholder text.
      input.placeholder = "π.χ. Χορήγηση...";
       }




      // Update the placeholder text.
      //input.placeholder = "π.χ. Χορήγηση...";
         //document.getElementById("code").innerHTML = edittoken;

    } else {
      // An error occured :(
      input.placeholder = "Couldn't load datalist options :(";
    }
};
// Update the placeholder text.
input.placeholder = "Loading options...";
xmlhttp.open("POST", thisServerFolder+"/api.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("action=query&format=json&list=allpages&utf8=1&aplimit=50000");


</script>

<div class="blueTable outerTableFooter">
<div class="tableFootStyle">
<div class="links"><a href="#S0">&laquo;</a> <a class="active" href="#S1">1</a> <a href="#S2">2</a> <a href="#S3">3</a> <a href="#S4">4</a> <a href="#S5">&raquo;</a></div>
</div>
</div>


<?php
$wikipage=$_GET["wp"];
$auto=$_GET["auto"];
if ($auto==1) {
echo "<script>document.getElementById('auto').checked = true;</script>Auto called!!!".$wikipage;
}
$print = "<script>urlsaved='".$wikipage."';document.getElementById('inURL').value='".$wikipage."';document.getElementById('URLin').innerHTML='".$wikipage."';setTimeout(auto, 2000);</script>";
echo $print; 


function callauto($in) {
$wikipage=$in;
$auto=1;
if ($auto==1) {
echo "<script>document.getElementById('auto').checked = true;</script>Auto called!!!".$wikipage;
}
$print = "<script>document.getElementById('inURL').value='".$wikipage."';document.getElementById('URLin').innerHTML='".$wikipage."';setTimeout(auto, 2000);</script>";
echo $print;
//return "OK";
}

?>
</body>
</html>