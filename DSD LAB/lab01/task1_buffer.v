module buffer(I,O);
input I;
output O;
buf b(O,I);
endmodule

module buffer_tb();
reg I;
wire O;
buffer inst(I,O);
initial begin  //for multiple lines
I=0;
#20 $display("I = %b",I,"O = %b",O);

I=1;
#20 $display("I = %b",I,"O = %b",O);
end
endmodule