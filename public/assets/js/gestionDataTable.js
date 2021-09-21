// //////////////////////////////////////////////////////////////////////////////// //
//                             DATATABLE INITIALIZATION                             //
// //////////////////////////////////////////////////////////////////////////////// //
$(document).ready(function () {
    $("#RentalSpaceTypeDataTable").DataTable(rentalSpaceTypeConfiguration);   
    $("#RentalSpaceDataTable").DataTable(rentalSpaceConfiguration);
    $("#CityDataTable").DataTable(cityConfiguration);   
});


// ////////////////////////////////////////////////////////////////////////////////// //
//                              DATATABLES CONFIGURATIONS                             //
// ////////////////////////////////////////////////////////////////////////////////// //

// ###################################### //
// ##           CITY DATATABLE         ## //
// ###################################### //
const cityConfiguration = 
{
    "scrollX": true,
    "stateSave": false,
    "order": [[0, "asc"]],
    "pagingType": "simple_numbers",
    "searching": true,
    "lengthMenu": [[10, 25, 50, 100, -1], ["Dix", "Vingt-cinq", "Cinquante", "Cent", "La totalité"]], 
    "language": 
    {
        "info": "Villes _START_ à _END_ sur _TOTAL_ sélectionnées",
        "emptyTable": "Aucune données",
        "lengthMenu": "_MENU_ villes par page",
        "search": "Rechercher dans le tableau : ",
        "zeroRecords": "Aucun résultat pour cette recherche",
        "paginate": 
        {
            "previous": "Précédent ",
            "next": " Suivant"
        },
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoEmpty":      "Ville 0 à 0 sur 0 sélectionnée",
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
            "orderable": false
        }
    ],
    "retrieve": true,
};


// ###################################### //
// ##    RENTALSPACE TYPE DATATABLE    ## //
// ###################################### //
const rentalSpaceTypeConfiguration = 
{
    "scrollX": true,
    "stateSave": false,
    "order": [[0, "asc"]],
    "pagingType": "simple_numbers",
    "searching": true,
    "lengthMenu": [[10, 25, 50, 100, -1], ["Dix", "Vingt-cinq", "Cinquante", "Cent", "La totalité"]], 
    "language": 
    {
        "info": "Types _START_ à _END_ sur _TOTAL_ sélectionnés",
        "emptyTable": "Aucune données",
        "lengthMenu": "_MENU_ Types par page",
        "search": "Rechercher dans le tableau : ",
        "zeroRecords": "Aucun résultat pour cette recherche",
        "paginate": 
        {
            "previous": "Précédent ",
            "next": " Suivant"
        },
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoEmpty":      "Type 0 à 0 sur 0 sélectionnée",
    },
    // ATTENTION : Une colonne sera cachée par la propriété 'columnDefs' qui suit...
    "columns": 
    [
        {
            "orderable": true
        },
        {
            "orderable": false
        }
    ],
    "retrieve": true,
};


// ###################################### //
// ##       RENTALSPACE DATATABLE      ## //
// ###################################### //
const rentalSpaceConfiguration = 
{
    "scrollX": true,
    "stateSave": false,
    "order": [[1, "asc"]],
    "pagingType": "simple_numbers",
    "searching": true,
    "lengthMenu": [[10, 25, 50, 100, -1], ["Dix", "Vingt-cinq", "Cinquante", "Cent", "La totalité"]], 
    "language": 
    {
        "info": "Espaces locatifs _START_ à _END_ sur _TOTAL_ sélectionnés",
        "emptyTable": "Aucune données",
        "lengthMenu": "_MENU_ espaces locatifs par page",
        "search": "Rechercher dans le tableau : ",
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
            "data": "tarif mois",
            "render": function(data, type) {
                var number = $.fn.dataTable.render.number( '.', ',', 0, '€'). display(data);
                if (type === 'display') {
                    let color = 'green';
                    if (data < 2500) {
                        color = 'red';
                    }
                    else if (data < 5000) {
                        color = 'orange';
                    }

                    return '<span style="color:' + color + '">' + number + '</span>';
                }
                return number;
            },
            "orderable": true
        },
        {
            "orderable": false
        }
    ],
    "columnDefs": 
    [
        {
            // The 'data' parameter refers to the data for the cell 
            // (defined by the 'data' option, which defaults to the column being worked with,
            // in this case 'data: 0').
            "render": function ( data, type, row ) {
                return data +"<br>("+ row[2]+")";
            },
            "targets": 1
        },
        // Colomn is no more diplayed
        { 
            "targets": [ 2 ],
            "visible": false
        }
    ],
    "retrieve": true,
};
