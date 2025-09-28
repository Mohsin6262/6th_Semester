`timescale 1ns / 1ps

module tb_mult_top;

    reg clk;
    reg reset;
    reg [3:0] A_input;
    reg [3:0] B_input;
    wire [7:0] result;

    mult_top uut (
        .clk(clk),
        .reset(reset),
        .A_input(A_input),
        .B_input(B_input),
        .result(result)
    );

    initial begin
        clk = 0;
        forever #5 clk = ~clk; // 10ns clock
    end

    initial begin
        // Initialize
        reset = 1;
        A_input = 0;
        B_input = 0;
        #20;

        // Load A = 5, B = 3 (5*3 = 15)
        reset = 0;
        A_input = 4'd5;
        B_input = 4'd3;
        #200;

        // End simulation
        $finish;
    end

endmodule
