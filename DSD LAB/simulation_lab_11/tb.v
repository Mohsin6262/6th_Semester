`timescale 1ns / 1ps

module factorial_tb;

    reg clk;
    reg reset;
    reg [3:0] A_input;
    wire [7:0] result;

    factorial_top uut (
        .clk(clk),
        .reset(reset),
        .A_input(A_input),
        .result(result)
    );

    // Clock Generation
    always #5 clk = ~clk;

    initial begin
        clk = 0;
        reset = 1;
        A_input = 0;

        #10;
        reset = 0;
        A_input = 4'd4; // Test factorial(4) = 24

        #100;
        $display("Factorial of 4 = %d", result);

        reset = 1;
        #10;
        reset = 0;
        A_input = 4'd5; // Test factorial(5) = 120

        #100;
        $display("Factorial of 5 = %d", result);

        $finish;
    end

endmodule
