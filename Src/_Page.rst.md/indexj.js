
function CreateDocument() {

    $('.alert .alert-text').text("Encrypting PDF. Please wait...");
    $('.alert').show();

    var form = {
        author: $("#author").val(),
        creationdate: $("#creationdate").val(),
        creatorApplication: $("#creatorApplication").val(),
        documentKeywords: $("#documentKeywords").val(),
        documentSubject: $("#documentSubject").val(),
        documentTitle: $("#documentTitle").val(),
    };

    var serviceURL = "@Url.Action("PDFSettings", "TX")";

    // send document to controller
    $.ajax({
        type: "POST",
        url: serviceURL,
        data: {
            documentSettings: form
        },
        success: successFunc,
        error: errorFunc
    });

}

function successFunc(data, status) {

    console.log(data);

    TXDocumentViewer.loadDocument(data, "results.pdf");
    createDownloadLink("results.pdf", data);
    $('.alert').hide();
}

function errorFunc() {
    alert("Error");
}

function createDownloadLink(name, content) {

    $("#buttonArea").empty();

    var dlink = document.createElement("a");
    dlink.download = name;
    dlink.textContent = "Download PDF";
    dlink.classList.add("btn", "mt-3", "btn-primary");
    dlink.href = "data:application/pdf;base64," + content;
    console.log(dlink.href);
    dlink.onclick = function (e) {

        var that = this;
        setTimeout(function () {
            window.URL.revokeObjectURL(that.href);
        }, 1500);
    };

    $("#buttonArea").append(dlink);
}
