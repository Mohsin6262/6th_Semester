module Sum(S,A,B);  //design module for sum
    input A,B;
    output S;
    xor x(S,A,B);
endmodule

module Carry(C,A,B);  //design module for carry
    input A,B;
    output C;
    and a(C,A,B);
endmodule

module HA(S,C,A,B);   //design module for half adder
    input A,B;
    output S,C;
    Sum s1(S,A,B);
    Carry c1(C,A,B);
endmodule

module FA(S,C,A,B,Cin);  //design module for full adder
    input A,B,Cin;
    output S,C;
    wire S1,C1,C2;
    
    HA h1(S1,C1,A,B);
    HA h2(S,C2,Cin,S1);
    or o(C,C1,C2);
endmodule

module RCA(S,Cout,A,B,Cin); //ripple carry adder design
    input [3:0] A,B;        //vector initilization
    input Cin;
    output [3:0] S;
    output Cout;
    wire [2:0] C;   
    FA f1(S[0],C[0],A[0],B[0],Cin);
    FA f2(S[1],C[1],A[1],B[1],C[0]); 
    FA f3(S[2],C[2],A[2],B[2],C[1]);  
    FA f4(S[3],Cout,A[3],B[3],C[2]);  
endmodule

module RCA_tb2(); //ripple carry adder test bench
    reg [3:0] A,B;
    reg Cin;
    wire [3:0] S;
    wire Cout;

    RCA rr(S,Cout,A,B,Cin);
    
    initial begin
        A = 4'b0000; B = 4'b0001; Cin = 1'b0; //4 bit A,B and 1 bit Cin
        #20;
        A = 4'b0101; B = 4'b0011; Cin = 1'b0; //4bit A,B and 1 bit Cin
    end  
    initial 
        $monitor("A=%b B=%b Sum=%b Cout=%b", A, B, S, Cout); //for display
endmodule
