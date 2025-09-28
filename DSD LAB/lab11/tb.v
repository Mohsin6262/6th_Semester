`timescale 1ns / 1ps

module factorial_tb;

    // Inputs
    reg clk;
    reg reset;
    reg [3:0] A_input;

    // Output
    wire [7:0] result;

    // Instantiate the top module
    factorial_top uut (
        .clk(clk),
        .reset(reset),
        .A_input(A_input),
        .result(result)
    );

    // Clock generation
    always #5 clk = ~clk; // 10ns clock period (100MHz)

    initial begin
        // Initialize inputs
        clk = 0;
        reset = 1;
        A_input = 4'd0;

        // Hold reset
        #10;
        reset = 0;

        // Test Case 1: A_input = 4 (expect 4! = 24)
        A_input = 4'd4;

        // Wait enough time for computation
        #100;

        // Display result
        $display("Factorial of %0d = %0d", A_input, result);

        // Test Case 2: A_input = 5 (expect 5! = 120)
        reset = 1;
        #10;
        reset = 0;
        A_input = 4'd5;

        #100;
        $display("Factorial of %0d = %0d", A_input, result);

        // End simulation
        #20;
        $finish;
    end

endmodule
