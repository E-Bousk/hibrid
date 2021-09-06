$(document).ready(function () {
    $("#dataTable").DataTable(configuration);   
});


// ///////////////////////////////////////////////////
// //////////// CONFIGURATION DATATABLE //////////////
// ///////////////////////////////////////////////////
const configuration = 
{
    "scrollX": true,
    "stateSave": false,
    "order": [[0, "asc"]],
    "pagingType": "simple_numbers",
    "searching": true,
    "lengthMenu": [[5, 10, 25, 50, 100, -1], ["Cinq", "Dix", "Vingt-cinq", "Cinquante", "Cent", "La totalité"]], 
    "language": 
    {
        "info": "Espaces locatifs _START_ à _END_ sur _TOTAL_ sélectionnés",
        "emptyTable": "Aucun utilisateur",
        "lengthMenu": "_MENU_ espaces locatifs par page",
        "search": "Rechercher dans tableau : ",
        "zeroRecords": "Aucun résultat pour cette recherche",
        "paginate": 
        {
            "previous": "Précédent ",
            "next": " Suivant"
        },
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoEmpty":      "Espaces locatifs 0 à 0 sur 0 sélectionné",
    },
    // ATTENTION : Une colonne sera cachée par la propriété 'columnDefs' qui suit...
    "columns": 
    [
        {
            "orderable": true
        },
        {
            "orderable": true
        },
        {
            "orderable": true
        },
        {
            "orderable": true
        },
        {
            "orderable": true
        },
        {
            "orderable": true
        },
        {
            "orderable": true
        },
        {
            "orderable": true
        },
        {
            "orderable": true
        },
        {
            "orderable": false
        }
    ],
    "columnDefs": 
    [
        {
            // The `data` parameter refers to the data for the cell (defined by the
            // `data` option, which defaults to the column being worked with, in
            // this case `data: 0`.
            "render": function ( data, type, row ) {
                return data +" ["+ row[2]+"]";
            },
            "targets": 0
        },
        // La colonne n'est plus affichée
        { "visible": false,  "targets": [ 2 ] }
    ],
    "retrieve": true,
};