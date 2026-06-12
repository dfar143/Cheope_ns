<?
namespace Cheope_ns\fw;
interface Factory_3
{
	public function create(Xml_interface_serializer $actCallerObj,
	Interfaces_container $actInterfacesContainer,
	?object $actDbStruct,
	?object $actDbQueries):object|string|null;
}

?>