module orgate(A, B, O);
input A, B;
output O;
wire nandout1, nandout2;
nand n1(nandout1, A);  
nand n2(nandout2, B); 
nand n3(O, nandout1, nandout2);

endmodule

module or_gate();
reg A, B;
wire O;
orgate x(A, B, O);

initial begin
    A = 0; B = 0;
    #20 $display("A = %b, B = %b, O = %b", A, B, O);
    
    A = 0; B = 1;
    #20 $display("A = %b, B = %b, O = %b", A, B, O);
    
    A = 1; B = 0;
    #20 $display("A = %b, B = %b, O = %b", A, B, O);
    
    A = 1; B = 1;
    #20 $display("A = %b, B = %b, O = %b", A, B, O);
end

endmodule