`timescale 1ns / 1ps

module tb_factorial_top();

    reg clk;
    reg reset;
    reg start;
    reg [3:0] A_in, B_in;
    wire [7:0] result;

    // Instantiate the top module
    factorial_top uut (
        .clk(clk),
        .reset(reset),
        .start(start),
        .A_in(A_in),
        .B_in(B_in),
        .result(result)
    );

    // Clock generation: 10 ns period (100 MHz)
    initial begin
        clk = 0;
        forever #5 clk = ~clk; // Toggle every 5ns
    end

    initial begin
        // Initialize inputs
        reset = 1;
        start = 0;
        A_in = 4'd0;
        B_in = 4'd0;

        // Wait some time and release reset
        #20;
        reset = 0;

        // Provide inputs
        B_in = 4'd5;      // Calculate factorial of 5 (B_in used)
        A_in = 4'd0;      // Not used in your code, but assigned anyway

        // Wait for a clock edge, then start FSM
        #10;
        start = 1;

        // Keep start high for a few cycles to move FSM forward
        #50;
        start = 0;

        // Wait long enough for factorial to compute with the slow clock
        #2000000; // Adjust depending on clock divider speed

        // Finish simulation
        $stop;
    end

endmodule
