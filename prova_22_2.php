<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_22_2_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div id=\"form1\" dojoType=\"dijit.form.Form\"  encType=\"multipart/form-data\" method=\"POST\" action=\"prova_22_2.php\">" .
 "<input tabIndex=\"1\" type=\"password\" style=\"color:black;\" tooltip=\"AAAAAATOOLTIP\"  promptMessage=\"PromptMessage\" dojoType=\"dijit.form.ValidationTextBox\" id=\"textBox1\" name=\"TextBox1\" format=\"formatValue\" " .
 " onchange=\"alert('change')\">" .
 "<script type=\"dojo/method\" event=\"onSubmit\">
        if (this.validate()) {
            return confirm('Form is valid, press OK to submit');
        } else {
            alert('Form contains invalid data.  Please correct first');
            return false;
        }
        return true;
    </script><br/><br/>" .
 "<input tabIndex=\"2\" style=\"color:black;width:180px;height:80px;padding:5px; border-radius:5px;\" dojoType=\"dijit.form.ValidationTextBox\" name=\"validation1\" " .
 " id=\"validation1\" required=\"true\" maxlength=\"5\" tooltip=\"AAAAAATOOLTIP\" tooltipPosition=\"below\" " .
 "promptMessage=\"PromptMessage\" value=\"AAAAA\" invalidMessage=\"Dato non valido\" regExp=\"[a-z]{2,5}\"><br/><br/>" .
 "<select tabIndex=\"3\" value=\"BBBBB\" style=\"color:black;\" dojoType=\"dijit.form.FilteringSelect\" name=\"FilteringSelect\" " .
 " id=\"filteringSelect\" onchange=\"alert(this.value)\" required=\"true\" ><option value=\"\">Selezionare...</option>" .
 "<option value=\"TN\">Tennesse</option>" .
 "<option value=\"VG\">Virginia</option></select></br></br>" .
 "<select tabIndex=\"4\" value=\"CCCCC\" style=\"color:black;\" dojoType=\"dijit.form.ComboBox\" name=\"ComboBox\" " .
 "  onchange=\"alert(this.value)\" required=\"true\" ><option value=\"\">Selezionare...</option>" .
 "<option value=\"TN\">Tennesse</option>" .
 "<option value=\"VG\">Virginia</option></select></br></br>" .
 "<select tabIndex=\"5\" required=\"true\" multiple=\"true\" name=\"multiple\" " .
 "dojoType=\"dijit.form.MultiSelect\" style=\"height:150px; " .
 "width:200px border:3px solid black\" onchange=\"alert(this.value)\">" .
 "<option value=\"TN1\">Tenessee</option>" .
 "<option value=\"VA1\">Virginia</option>" .
 "<option value=\"WV1\">West Virginia</option>" .
 "</select><br/><br/>" .
 "<textarea name=\"text1\" value=\"ZZZZZZZZZZ\" dojoType=\"dijit.form.SimpleTextarea\" required=\"true\" style=\"height:200px;width:300px\"></textarea><br/><br/>" .  
 "<input name=\"radio\" value=\"1\" dojoType=\"dijit.form.RadioButton\"> day1<br>" .
 "<input name=\"radio\" checked value=\"2\" dojoType=\"dijit.form.RadioButton\"> day2<br>" .
 "<input name=\"radio\" value=\"3\" dojoType=\"dijit.form.RadioButton\"> day3<br/><br/>" .
 "<label>label1</label><div name=\"confirmation\" checked dojoType=\"dijit.form.CheckBox\"></div><br/><br/>" .
 "<input tabIndex=\"6\" style=\"color:black;\" required=\"true\" " .
 "value=\"2015-10-15\" " .
 "name=\"data1\" id=\"data1\" dojoType=\"dijit.form.DateTextBox\"><br/><br/>" .
 "<input tabIndex=\"7\" style=\"color:black;\" name=\"data2\" id=\"data2\" dojoType=\"dijit.form.TimeTextBox\"><br/><br/>" .
 "<br/><button dojoType=\"dijit.form.Button\" type=\"submit\" name=\"submitButton\" value=\"Submit\">" .
 "Submit</button></div><button type=\"button\">Out</button>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_22_2_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
