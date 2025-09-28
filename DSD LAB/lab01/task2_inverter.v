module invertor(I,O);
input I;
output O;
not a(O,I);
endmodule 

module invertor_dut();
reg I;
wire O;
invertor b(I,O);
initial
begin
I=0;
#20 $display("I=%b",I,"O=%b",O);
I=1;
#20 $display("I=%b",I,"O=%b",O);
end
endmodule