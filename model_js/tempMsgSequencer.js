var tempMsgSeq = function(){

return {
"TEMP_MSGS_WITH_SEQUENCER_ACTIVE_NUM":"",
"ctTempMsgsSeqs":Array(this.TEMP_MSGS_WITH_SEQUENCER_ACTIVE_NUM),
"tempMsgsSequenceActivate":function()
{                    
 for(var i=0;i<=this.TEMP_MSGS_WITH_SEQUENCER_ACTIVE_NUM-1;i++)
 {
 	var ct = eval('this.tempMsg' + i + 'SeqStrings.length');
 	if(this.ctTempMsgsSeqs[i]<=ct-1)
 	{
 	 var el=document.getElementById('temp_msg' + '__' + i + '_' + 'text_field').childNodes[0];
 	 el.data=eval('this.tempMsg' + i + 'SeqStrings[' + this.ctTempMsgsSeqs[i] + ']');
 	 this.ctTempMsgsSeqs[i]++;
  }
  else
   this.ctTempMsgsSeqs[i]=0;
 }
}
}
}();