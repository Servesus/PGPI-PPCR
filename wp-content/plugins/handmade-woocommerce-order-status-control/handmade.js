//('#hmade_v')
//('#hmade_all')

jQuery('#hmade_v').click(function() {
    if(jQuery('#hmade_v').is(":checked"))
    {
        jQuery('#hmade_all').prop('checked', false); 
    }
    
})

jQuery('#hmade_all').click(function() {
    if(jQuery('#hmade_all').is(":checked"))
    {
        jQuery('#hmade_v').prop('checked', false); 
    }
    
})
