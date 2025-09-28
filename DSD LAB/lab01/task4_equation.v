module equ(Z,x1,x2,x3,x4,x5);
input x1,x2,x3,x4,x5;
output Z;
wire y1;
wire y2;
and n1(y1,x1,x2);
and n2(y2,x3,x4,x5);
nor n3(Z,y1,y2);
endmodule

module equ_tb();
reg x1,x2,x3,x4,x5;
wire Z;
equ ins(Z,x1,x2,x3,x4,x5);
initial begin  
x1=0;
x2=0;
x3=0;
x4=0;
x5=0;
#20 $display("x1 = %b",x1, "x2 = %b",x2,"x3 = %b",x3,"x4 = %b",x4,"x5 = %b",x5,"Z = %b",Z);

x1=0;
x2=0;
x3=0;
x4=0;
x5=1;
#20 $display("x1 = %b",x1, "x2 = %b",x2,"x3 = %b",x3,"x4 = %b",x4,"x5 = %b",x5,"Z = %b",Z);

x1=0;
x2=0;
x3=0;
x4=1;
x5=0;
#20 $display("x1 = %b",x1, "x2 = %b",x2,"x3 = %b",x3,"x4 = %b",x4,"x5 = %b",x5,"Z = %b",Z);

x1=0;
x2=0;
x3=0;
x4=1;
x5=1;
#20 $display("x1 = %b",x1, "x2 = %b",x2,"x3 = %b",x3,"x4 = %b",x4,"x5 = %b",x5,"Z = %b",Z);
end
endmodule

