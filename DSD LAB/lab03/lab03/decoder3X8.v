`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date:    06:34:35 03/10/2025 
// Design Name: 
// Module Name:    decoder3X8 
// Project Name: 
// Target Devices: 
// Tool versions: 
// Description: 
//
// Dependencies: 
//
// Revision: 
// Revision 0.01 - File Created
// Additional Comments: 
//
//////////////////////////////////////////////////////////////////////////////////
module decoder3x8(A, B, C, D);
    input A, B, C;  // 3 input lines
    output [7:0] D; // 8 output lines

    assign D[0] = ~A & ~B & ~C;
    assign D[1] = ~A & ~B & C;
    assign D[2] = ~A & B & ~C;
    assign D[3] = ~A & B & C;
    assign D[4] = A & ~B & ~C;
    assign D[5] = A & ~B & C;
    assign D[6] = A & B & ~C;
    assign D[7] = A & B & C;
endmodule
