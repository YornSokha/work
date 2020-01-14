function createInputWithLabel(name,type, js=null) {
    let label = "<label>"+name+":</label>";
    let input = "<input type='"+type+"' id='"+name+"' name='"+name+"'"+((js != null) ? "onclick='"+js+"'":'');
    return label + input;
}