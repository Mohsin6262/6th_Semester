module logic_circuit(output Y, input A, B, C);
    wire A_not, X1, X2, X2_not, Y1, Y2, Y1_not;

    // Inverters
    not n1(A_not, A);
    not n2(X1_not, X1);

    // AND Gates
    nand a2(X1,B, C);
    and a3(X2,X1,B);
    and a1(Y1, A_not, X2);
    // XOR Gate
    xor x1(Y2, X2, X1_not);

    // Inverter for Y1
    not n3(Y1_not, Y1);

    // OR Gate
    or o1(Y, Y1_not, Y2);
endmodule

module logic_circuit_tb();
    reg A, B, C;
    wire Y;
    logic_circuit uut(Y, A, B, C);

    initial begin
        // Display header
        $display("A  B  C  |  Y");
        $display("----------------");

        // Test all possible input combinations
        A = 0; B = 0; C = 0; #10; $display("%b  %b  %b  |  %b", A, B, C, Y);
        A = 0; B = 0; C = 1; #10; $display("%b  %b  %b  |  %b", A, B, C, Y);
        A = 0; B = 1; C = 0; #10; $display("%b  %b  %b  |  %b", A, B, C, Y);
        A = 0; B = 1; C = 1; #10; $display("%b  %b  %b  |  %b", A, B, C, Y);
        A = 1; B = 0; C = 0; #10; $display("%b  %b  %b  |  %b", A, B, C, Y);
        A = 1; B = 0; C = 1; #10; $display("%b  %b  %b  |  %b", A, B, C, Y);
        A = 1; B = 1; C = 0; #10; $display("%b  %b  %b  |  %b", A, B, C, Y);
        A = 1; B = 1; C = 1; #10; $display("%b  %b  %b  |  %b", A, B, C, Y);

        $stop;
    end
endmodule